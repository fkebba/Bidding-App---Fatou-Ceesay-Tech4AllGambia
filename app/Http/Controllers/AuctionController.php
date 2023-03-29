<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuctionController extends Controller
{

    public function index(Request $request)
    {
        $query = Auction::withcount('bids')->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        if (auth()->user()) {
            $auctions = $query->where('user_id',  '!=', auth()->user()->id)->paginate(10);
        }else{
        $auctions = $query->paginate(10);

        }

        return view('auctions.index', compact('auctions'));
    }

    public function create()
    {
        return view('auctions.create');
    }

    public function store(Request $request)
    {

        // Validate the Request when user sending form data..........
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'end_time' => 'required|date',
            'photo' => 'nullable|image',
        ]);

        $fileName = null;

        if ($request->photo) {

            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('Auctions/', $fileName);
        }

        $auction = Auction::create($request->except('photo') + [
            'photo' => $fileName, 'user_id' => $request->user()->id]);

        // After creation redirect back to the auction show view...........

        return redirect()->route('auctions.show', $auction)->with('success', 'Auction created successfully!');

    }

    public function show(Auction $auction)
    {
        $auction = $auction->load('bids');

        return view('auctions.show', compact('auction'));
    }

    public function edit(Auction $auction)
    {
        return view('auctions.edit', compact('auction'));
    }

    public function update(Request $request, Auction $auction)
    {
        $this->validate($request, [
            'name' => ['required', Rule::unique('auctions')->ignore($auction->id)],
            'description' => 'required',
            'price' => 'required|numeric',
            'end_time' => 'required|date|after:tomorrow',
            'photo' => 'nullable|image',
        ]);


        $fileName = null;

        if ($request->photo) {

            if (!empty($auction->photo)) {
              unlink(public_path('Auctions/' . $auction->photo));
            }

            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('Auctions/', $fileName);
        }

        $auction->update($request->except('photo') +  ['photo' => !empty($fileName) ? $fileName : $auction->photo]);

        return redirect()->route('home')->with('status', 'Auction updated successfully!');

    }

    public function destroy(Auction $auction)
    {
        $auction->delete();

        return redirect()->route('home')->with('success', 'Auction deleted successfully.');
    }

}

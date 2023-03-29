<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Mail\ItemSuggested;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class SuggestedItemController extends Controller
{
    

    public function index()
    {
        return view('items.suggest-item');
    }
    
    public function suggestItem(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string|max:1000',
        ]);

        // dd($request->only(['name', 'description']));

        // Save suggestion to database
        $item = Item::create($request->only(['name', 'description']) + ['user_id' => auth()->id()]);

        // dd($item);
        // Send email to admin
        $data = [
            'name' => $item->name,
            'description' => $item->description,
            'user' => $item->user,
        ];

        Mail::to('admin@example.com')->send(new ItemSuggested($data));

        return redirect()
            ->back()
            ->with('success', 'Item suggestion submitted successfully!');
    }


    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $item->update($request->all());

        return redirect()->route('home')->with('status', 'Item updated successfully!');

    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('home')->with('success', 'Item deleted successfully.');
    }


}

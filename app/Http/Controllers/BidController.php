<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;

class BidController extends Controller
{

       // Implementing the Bidding Functionality for users to able to bid

       public function storeBid(Request $request, $auctionId)
       {
   
           $request->validate(['bid_amount' => 'required|numeric']);
   
           $user = auth()->user();
           $auction = Auction::findOrFail($auctionId);
   
           // Check if bid is higher than current highest bid
           $highestBid = $auction->bids->max('bid_amount');
   
           if ($auction->user_id == auth()->user()->id) {
   
               return redirect()
                   ->back()
                   ->with(['error' => 'You cannot bid your own product..................']);
           }
   
           if ($request->bid_amount <= $highestBid) {
   
               return redirect()
                   ->back()
                   ->with(['error' => 'Your bid must be higher than the current highest bid!']);
           }
   
           // Save bid to database
           Bid::create([
               'bid_amount' => $request->bid_amount,
               'user_id' => $user->id,
               'auction_id' => $auction->id,
               'group_id' => $request->group_id,
           ]);
   
           return redirect()
               ->back()
               ->with('success', 'Your bid has been submitted!');
       }
    
    public function edit(Bid $bid)
    {
        $auction = Auction::find($bid->auction_id);
        return view('auctions.show', compact('bid', 'auction'));
    }

    public function update(Request $request, Bid $bid)
    {
        $request->validate(['bid_amount' => 'required|numeric']);
   
        $user = auth()->user();
        $auction = Auction::findOrFail($bid->auction_id);

        // Check if bid is higher than current highest bid
        $highestBid = $auction->bids->max('bid_amount');



        if ($auction->user_id == auth()->user()->id) {

            return redirect()
                ->back()
                ->with(['error' => 'You cannot bid your own product..................']);
        }

        // dd($request->bid_amount);


        if ($request->bid_amount <= $highestBid) {

            return redirect()
                ->back()
                ->with(['error' => 'Your bid must be higher than the current highest bid!']);
        }



        $bid->update($request->all());

        return redirect()->route('home')->with('status', 'Bid updated successfully!');

    }

    public function destroy(Bid $bid)
    {
        $bid->delete();

        return redirect()->route('home')->with('success', 'Bid deleted successfully.');
    }

}

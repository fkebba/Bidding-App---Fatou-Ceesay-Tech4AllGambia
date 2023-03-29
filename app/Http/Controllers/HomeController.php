<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = auth()->user();
        $bids = $user->bids()->paginate(10);
        $auctions = $user->auctions()->paginate(10);
        $suggests = $user->suggests()->paginate(10);

        return view('home', compact('bids', 'auctions', 'suggests'));
    }
}

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\SuggestedItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// is global 
Route::get('/', [AuctionController::class, 'index'])->name('auctions.index');


// Users that are logged in will able to use these routes.......

Route::middleware(['auth'])->group(function () { 

Route::get('/auctions/create', [AuctionController::class , 'create'])->name('auctions.create');
Route::post('/auctions/store', [AuctionController::class, 'store'])->name('auctions.store');
Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');
Route::get('/auctions/{auction}/edit', [AuctionController::class, 'edit'])->name('auctions.edit');
Route::put('/auctions/{auction}', [AuctionController::class, 'update'])->name('auctions.update');
Route::delete('/auctions/{auction}', [AuctionController::class, 'destroy'])->name('auctions.destroy');


Route::get('auctions/bid/{bid}/edit', [BidController::class, 'edit'])->name('auctions.bid.edit');
Route::put('/auctions/bid/{bid}', [BidController::class, 'update'])->name('auctions.bid.update');
Route::post('/auctions/bid/{auction}', [BidController::class, 'storeBid'])->name('auctions.bid');
Route::delete('/auctions/bid/{bid}', [BidController::class, 'destroy'])->name('auctions.bid.destroy');


//  Suggested Item Section Routes

Route::get('/suggest', [SuggestedItemController::class , 'index'])->name('auctions.suggest');
Route::post('suggest/store', [SuggestedItemController::class , 'suggestItem'])->name('auctions.suggest-item');
Route::get('suggest/{item}/edit', [SuggestedItemController::class, 'edit'])->name('auctions.suggest.edit');
Route::put('/suggest{item}', [SuggestedItemController::class, 'update'])->name('auctions.suggest.update');
Route::delete('/suggest{item}', [SuggestedItemController::class, 'destroy'])->name('auctions.suggest.destroy');


});

//  These Set of routes contains lots of authencated user routes such as (login, register, password reset, etc..).
Auth::routes();

//  this below route is the home route such as dashboard...

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

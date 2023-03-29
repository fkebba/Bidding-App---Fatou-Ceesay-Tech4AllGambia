@extends('layouts.app')

<style>
    .sidebar ul li {
        list-style: none;
        line-height: 10px;
        font-size: 14px;
        padding: 2px;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body sidebar">
                    <ul>
                        <li>
                            <a href="{{route('auctions.create')}}" class="btn btn-primary pr-2">Create Auction</a>
                        </li>
                        <li>
                            <a href="{{route('auctions.suggest')}}" class="btn btn-primary pr-2">Suggest Item</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h3>My Auctions</h3>
                    <br>
                    <br>
                    <div class="row">
                        @forelse ($auctions as $auction)
                        <div class="col-md-3 mb-2">
                            <div class="card">
                            <div class="card-header">
                                <img src="{{asset( !empty($auction->photo) ? 'Auctions/'. $auction->photo : 'empty.jpg')}}" alt="" width="120">
                            </div>
                            <div class="card-body">
                                <strong>{{$auction->name}}</strong> <br>
                                <strong>GMD {{number_format($auction->price, 2)}}</strong> <br>
                                <strong class="text-danger">Bids:  {{$auction->bids_count}}</strong>
                            </div>
                            <div class="card-footer pr-0 pl-0">
                                <a class="btn btn-info btn-sm"  href="{{route('auctions.show', $auction)}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary btn-sm"  href="{{route('auctions.edit', $auction)}}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm"  href="{{route('auctions.destroy', $auction)}}" onclick="event.preventDefault();
                                document.getElementById('auction-delete-form').submit();"><i class="fa fa-trash"></i></a>

                                <form id="auction-delete-form" action="{{ route('auctions.destroy', $auction) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                            </div>
                        </div>
                        @empty
                            <h5 class="text-center">No Auctions</h5>
                        @endforelse
                    </div>
                </div>

                
                <div class="card-body">
                    <hr>
                    <h3>My Bids</h3>
                    <br>
                    <br>
                    <div class="row">
                        @forelse ($bids as $bid)
                        <div class="col-md-3 mb-2">
                            <div class="card">
                            <div class="card-header">
                                <img src="{{asset( !empty($bid?->auction?->photo) ? 'Auctions/'. $bid?->auction?->photo : 'empty.jpg')}}" alt="" width="60">
                            </div>
                            <div class="card-body">
                                <strong>{{$bid?->auction?->name}}</strong> <br>
                                <strong>GMD {{number_format($bid?->auction?->price, 2)}}</strong> <br>
                                <strong class="text-danger">Bid:  GMD {{$bid?->bid_amount}}</strong>
                            </div>
                                <div class="card-footer pr-0 pl-0">
                                    <a class="btn btn-info btn-sm"  href="{{route('auctions.show', $bid?->auction)}}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm"  href="{{route('auctions.bid.edit', $bid)}}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm"  href="{{route('auctions.bid.destroy', $bid)}}" onclick="event.preventDefault();
                                    document.getElementById('bid-delete-form').submit();"><i class="fa fa-trash"></i></a>
    
                                    <form id="bid-delete-form" action="{{ route('auctions.bid.destroy', $bid) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <h5 class="text-center">No Bids</h5>
                        @endforelse
                    </div>
                </div>

                <div class="card-body">
                    <hr>
                    <h3>My Sugested Items</h3>
                    <br>
                    <br>
                  <div class="row">
                    @forelse ($suggests as $suggest)
                    <div class="col-md-3 mb-2">
                        <div class="card">
                        <div class="card-body">
                            <strong>{{$suggest?->name}}</strong> <br>
                            <strong class="text-danger">{{Str::limit($suggest?->description, 20)}}</strong>
                        </div>
                        <div class="card-footer pr-0 pl-0">
                            <a class="btn btn-primary btn-sm"  href="{{route('auctions.suggest.edit', $suggest)}}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm"  href="{{route('auctions.suggest.destroy', $suggest)}}" onclick="event.preventDefault();
                            document.getElementById('suggest-delete-form').submit();"><i class="fa fa-trash"></i></a>

                            <form id="suggest-delete-form" action="{{ route('auctions.suggest.destroy', $suggest) }}" method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                        </div>
                    </div>
                    @empty
                    <h5 class="text-center">No Suggests</h5>
                    @endforelse
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .suggested-items{
        margin: 2px !important;
    }
</style>
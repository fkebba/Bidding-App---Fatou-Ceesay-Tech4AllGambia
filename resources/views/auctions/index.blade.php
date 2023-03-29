@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Auctions</div>

                    <div class="card-body">
                        <form action="{{ route('auctions.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request()->query('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Go</button>
                                </span>
                            </div>
                        </form>

                        <br><br>

                      <div class="row">
                        @forelse ($auctions as $auction)
                        <div class="col-md-2 mb-2">
                            <div class="card">
                            <div class="card-header">
                                <img src="{{asset( !empty($auction->photo) ? 'Auctions/'. $auction->photo : 'empty.jpg')}}" alt="" width="120">
                            </div>
                            <div class="card-body">
                                <strong>{{$auction->name}}</strong> <br>
                                <strong>GMD {{number_format($auction->price, 2)}}</strong> <br>
                                <strong class="text-danger">Bids:  {{$auction->bids_count}}</strong>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-info"  href="{{route('auctions.show', $auction)}}">View Detail</a>
                            </div>
                            </div>
                        </div>
                        @empty
                            
                        @endforelse
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

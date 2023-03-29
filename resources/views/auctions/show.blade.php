@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- <div id="countdown"></div> --}}


        <div class="row">
            <div class="col-md-8">
                <h2>Auction</h2>
                <div class="card">
                    <img src="{{asset( !empty($auction->photo) ? 'Auctions/'. $auction->photo : 'empty.jpg')}}" alt="" width="120">
                    <div class="card-header">{{ $auction->name }}</div>

                    <div class="card-body">
                        <p>{{ $auction->description }}</p>

                        <p><strong class="text-danger">Main Price:</strong> GMD {{ $auction->price}}</p>
                        <p><strong>Current Bid:</strong> GMD {{ $auction->bids->max('bid_amount') ??  $auction->price}}</p>

                        @if (auth()->user()->id != $auction->user_id )
                        <hr>
                        <br>
                        <form method="POST" 
                        @if (isset($bid))
                        action="{{ route('auctions.bid.update', $auction) }}"
                        @else
                        action="{{ route('auctions.bid', $auction) }}"
                        @endif
                        >
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="bid_amount">Bid Amount (GMD)</label>
                                <input id="bid_amount" type="number"
                                    class="form-control @error('bid_amount') is-invalid @enderror" name="bid_amount"
                                    @isset($bid) 
                                    value="{{ $bid->bid_amount}}"
                                    @endisset required>

                                @error('bid_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Place Bid') }}
                            </button>
                            <a class="btn btn-danger" href="{{url()->previous()}}">Cancel</a>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>All Bids</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            @forelse ($auction->bids as $bid)
                            <li><a href="">GMD {{$bid->bid_amount}}</a></li>
                            @empty
                                <li>No Bids Yet..............!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
    .card-body ul li{
        list-style: none;
        border-bottom: 1px solid gray;
    }
    .card-body ul li a{
      text-decoration: none;
      font-size: 20px;
      font-family: monospace;
    }
</style>



<script>
    var countDownDate = new Date("{{ $auction->end_time }}").getTime();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds +
            "s ";

        if (distance < countDownDate) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Auction has ended!";
        }
    }, 1000);
</script>

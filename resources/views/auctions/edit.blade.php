@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card bg-gray">
                    <div class="card-header">Edit Auction</div>

                    <div class="card-body">
                        <form action="{{ route('auctions.update', $auction) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Name" name="name"
                                    value="{{ $auction->name }}">
                            </div>
                            <div class="input-group mb-3">
                                <textarea name="description" id="description" cols="5" rows="2" class="form-control">{{ $auction->description }}</textarea>
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Price" name="price"
                                    value="{{ $auction->price }}">
                            </div>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" placeholder="End Time" name="end_time"
                                    value="{{ $auction->end_time?->format('Y-m-d') }}">
                            </div>
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" placeholder="Photo" name="photo">
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{ asset(!empty($auction->photo) ? 'Auctions/' . $auction->photo : 'empty.jpg') }}"
                                            alt="" width="80">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-sm btn-success pr-2">Submit</button>
                                    <a href="{{ route('home') }}" class="btn btn-sm btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
    .bg-gray {
        background: gainsboro;
    }
</style>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card bg-gray">
                    <div class="card-header">Create Auctions</div>

                    <div class="card-body">
                        <form action="{{ route('auctions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Name" name="name">
                            </div>
                            <div class="input-group mb-3">
                                <textarea name="description" id="description" cols="5" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Price" name="price">
                            </div>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" placeholder="End Time" name="end_time">
                            </div>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" placeholder="Photo" name="photo">
                            </div>

                            <div class="card-footer">
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-sm btn-success pr-2">Submit</button>
                                    <a href="{{route('home')}}" class="btn btn-sm btn-danger">Cancel</a>
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
    .bg-gray{
        background: gainsboro;
    }
</style>
@extends('layouts.app')

@section('content')
@section('title', 'New Hotel')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    Create new hotel
                </div>
                <div class="card-body">
                    <form action="{{route('hotels-store')}}" method="post">

                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="form-select" name="country_id">
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->title}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Hotel</label>
                            <input type="text" name="hotel_title" class="form-control" placeholder="hotel title" value="{{old('hotel_title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Duration</label>
                            <input type="text" name="hotel_duration" class="form-control" placeholder="duration" value="{{old('hotel_duration')}}">

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" name="hotel_price" class="form-control" placeholder="price" value="{{old('hotel_price')}}">

                        </div>
                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-info mt-4">Save</button>
                        </div>
                        @csrf

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

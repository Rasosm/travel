@extends('layouts.app')

@section('content')
@section('title', 'New Hotel')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    <h3>Create new hotel</h3>

                </div>
                <div class=" card-body">
                    <form action="{{route('hotels-store')}}" method="post" enctype="multipart/form-data">


                        {{-- <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="form-select" name="country_id">
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->title}}</option>
                        @endforeach
                        </select>
                </div> --}}

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <select class="form-select" name="country_id">
                        @foreach($countries as $country)
                        <option value="{{$country->id}}" @if($country->id == old('country_id')) selected @endif>{{$country->title}} ({{$country->season_start}} - {{$country->season_end}})</option>





                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hotel</label>
                    <input type="text" name="hotel_title" class="form-control" placeholder="hotel title" value="{{old('hotel_title')}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Check In</label>
                    <input type="date" name="hotel_start" class="form-control" placeholder="season start" value="{{old('country_season_start')}}">
                </div>
                {{-- <div class="mb-3">
                            <label class="form-label">Check Out</label>
                            <input type="date" name="hotel_end" class="form-control" placeholder="season end" value="{{old('country_season')}}">
            </div> --}}



            <div class="mb-3">
                <label class="form-label">Duration</label>
                <input type="text" name="hotel_duration" class="form-control" placeholder="duration" value="{{old('hotel_duration')}}">

            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="hotel_price" class="form-control" placeholder="price" value="{{old('hotel_price')}}">

            </div>
            <div class="col-5">
                <div class="mb-3">
                    <label class="form-label">Hotel Photo</label>
                    <input type="file" class="form-control" name="photo">
                </div>
            </div>
            <div class="col-9">
                <div class="mb-3">
                    <label class="form-label">Hotel description</label>
                    <textarea class="form-control" rows="10" name="hotel_desc">{{old('hotel_desc')}}</textarea>
                </div>
            </div>


            <div class="mb-3" style="justify-content: center; display: flex">
                <button type="submit" class="btn btn-outline-warning mt-4">Save</button>

            </div>
            @csrf

            </form>
        </div>
    </div>
</div>

</div>
</div>

@endsection

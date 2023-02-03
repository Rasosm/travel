@extends('layouts.app')

@section('content')
@section('title', 'Edit Hotel')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    Edit hotel
                </div>
                <div class="card-body">
                    <form action="{{route('hotels-update', $hotel)}}" method="post" enctype="multipart/form-data">


                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="form-select" name="country_id">
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" @if($country->id == $hotel->country_id) selected @endif>{{$country->title}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Hotel</label>
                            <input type="text" name="hotel_title" class="form-control" value="{{$hotel->title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Duration</label>
                            <input type="text" name="hotel_duration" class="form-control" value="{{$hotel->duration}}">


                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" name="hotel_price" class="form-control" value="{{$hotel->price}}">
                        </div>

                        @if($hotel->photo)
                        <div class="col-4">
                            <div class="mb-3 img">
                                <img src="{{asset($hotel->photo)}}">
                            </div>
                        </div>
                        @endif
                        <div class="col-5">
                            <div class="mb-3">
                                <label class="form-label">Hotel Photo</label>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>
                        @if($hotel->photo)
                        <button type="submit" class="btn btn-outline-danger" name="delete_photo" value="1">Delete Photo</button>
                        @endif




                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-info mt-4">Save</button>
                        </div>
                        @csrf
                        @method('put')

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

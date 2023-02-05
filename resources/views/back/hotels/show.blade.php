@extends('layouts.app')

@section('content')
@section('title', 'Edit Hotel')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    <h3>About hotel</h3>

                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Country:</label>
                        {{$hotel->hotelCountry?->title}}
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hotel:</label>
                        {{$hotel->title}}
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        {{$hotel->duration}} nights
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        {{$hotel->price}} eur
                    </div>



                    <div class="col-9">
                        <div class="mb-3">
                            <label class="form-label">Hotel description</label>
                            <div>{{$hotel->desc}}</div>

                        </div>
                    </div>
                    @if($hotel->photo)
                    <div class="col-4">
                        <div class="mb-3 img">
                            <img src="{{asset($hotel->photo)}}">
                        </div>
                    </div>
                    @endif


                    <div class="mb-3" style="justify-content: center; display: flex">
                        <a href={{route('hotels-pdf', $hotel)}} class="btn btn-outline-info mt-4">Dowload PDF</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@extends('layouts.front')



@section('content')
@section('title', 'Hotel list')


<div class="container">
    <div class="row justify-content-center">

        <form action="{{route('hotels-index')}}" method="get">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-3">
                        <div class="mb-3">
                            <label class="form-label">Paieška</label>
                            {{-- <input type="text" class="form-control" name="s" value="{{$s}}"> --}}
                            <input type="text" class="form-control" name="s" value="">


                        </div>
                    </div>
                    <div class=" col-4">
                        <div class="head-buttons">
                            <button type="submit" class="btn btn-outline-primary mt-3">Ieškoti</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <div>

            <div class="container">
                <div class="row justify-content-center">

                    @forelse($hotels as $hotel)
                    <div class="col-3">


                        <div class="list-table">
                            <div class="card" style="margin-bottom: 5px">
                                <a href="{{route('show-hotel', $hotel)}}">

                                    <div class="smallimg">
                                        @if($hotel->photo)
                                        <img src="{{asset($hotel->photo)}}">
                                        @endif
                                    </div>
                                </a>


                                <div class="card-header" style="display: inherit">
                                    <p class="card-title" style="font-size: 18px; font-weight: bold; line-height: 1.4">{{$hotel->title}}</p>
                                    <p class="card-title" style="margin-left: 7px;">{{$hotel->hotelCountry->title}}</p>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{$hotel->duration}} nights</p>
                                    <p style="font-weight: bold"> Price: {{$hotel->price}} eur</p>

                                </div>
                                <div class="buy">
                                    <div class="price"> {{$hotel->price}}Eur</div>
                                    <form action="{{route('add-to-cart')}}" method="post">
                                        <button type="submit" class="btn btn-outline-primary">Add</button>
                                        <input type="number" min="1" name="count" value="1">
                                        <input type="hidden" name="product" value="{{$hotel->id}}">
                                        @csrf
                                        <form>
                                </div>


                            </div>
                        </div>

                    </div>
                    @empty
                    <div class="list-group-item">No types yet</div>
                    @endforelse

                </div>
            </div>
        </div>






        <div class="m-2">{{ $hotels->links() }}</div>



    </div>
</div>





@endsection

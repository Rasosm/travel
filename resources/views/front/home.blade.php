@extends('layouts.front')



@section('content')
@section('title', 'Hotel list')


<div class="container">
    <div class="row justify-content-center">

        <form action="{{route('start')}}" method="get">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-2">
                        <div class="mb-3">
                            <label class="form-label">Paieška</label>
                            <input type="text" class="form-control" name="s" value="{{$s}}">
                        </div>
                    </div>
                    <div class=" col-4">
                        <div class="head-buttons">
                            <button type="submit" class="btn btn-outline-success" style="margin-top: 30px">Ieškoti</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form action="{{route('start')}}" method="get">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <div class="mb-3">
                            <label class="form-label">Sort</label>
                            <select class="form-select" name="sort">
                                <option>default</option>
                                @foreach($sortSelect as $value => $name)
                                <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-1">
                        <div class="mb-3">
                            <label class="form-label">Show</label>
                            <select class="form-select" name="per_page">
                                @foreach($perPageSelect as $value)
                                <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-3">
                            <label class="form-label">Select Country</label>
                            <select class="form-select" name="country_id">
                                <option value="all">All</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" @if($country->id == $countryShow) selected @endif>{{$country->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-2 ">
                        <div class=" head-buttons">
                            <button type="submit" class="btn btn-outline-success" style="margin-right: 5px; margin-top: 30px">Submit</button>

                            <a href="{{route('start')}}" class="btn btn-outline-success" style="margin-top: 30px">Update</a>




                        </div>
                    </div>

                </div>
            </div>


        </form>

        <div>

            <div class="container">
                <div class="row justify-content-center">

                    @forelse($hotels as $hotel)
                    <div class="col-3 one-card">


                        <div class="list-table">
                            <div class="">
                                <a href="{{route('show-hotel', $hotel)}}">

                                    <div class="smallimg">
                                        @if($hotel->photo)
                                        <img src="{{asset($hotel->photo)}}">
                                        @else
                                        <img src="{{asset('/hotels/no.jpg')}}">
                                        @endif
                                    </div>
                                </a>

                                <div class="card-header">
                                    <p class="card-title" style="font-size: 18px; font-weight: bold; line-height: 1.4">{{$hotel->title}}***</p>
                                    <p class="card-title">{{$hotel->hotelCountry->title}}</p>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{$hotel->start}} - {{$hotel->end}}</p>
                                    {{-- <p class="card-text">{{$hotel->startNice}} - {{$hotel->endNice}}</p>
                                    --}}

                                    <p class="card-text">{{$hotel->duration}} nights</p>
                                    <p style="font-weight: bold"> Price: {{$hotel->price}} eur</p>

                                </div>
                                <div class="buy">

                                    <form action="{{route('add-to-cart')}}" method="post">
                                        <button type="submit" class="btn btn-outline-primary">Add</button>
                                        <input class="input-buy" type="number" min="1" name="count" value="1">
                                        <input type="hidden" name="product" value="{{$hotel->id}}">
                                        @csrf
                                    </form>
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
        @if($perPageShow != 'all')
        <div class="m-2">{{$hotels->links()}}
        </div>
        @endif

    </div>
</div>





@endsection

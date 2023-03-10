@extends('layouts.app')

@section('content')
@section('title', 'Hotel list')


<div class="container">
    <div class="row justify-content-center">

        <form action="{{route('hotels-index')}}" method="get">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <div class="mb-3">
                            <label class="form-label"></label>
                            <input type="text" class="form-control" name="s" value="{{$s}}">


                        </div>
                    </div>
                    <div class=" col-1">
                        <div class="head-buttons">
                            <button type="submit" class="btn btn-outline-primary mt-4">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>




        {{-- <form action="{{route('customers-index')}}" method="get">
        <div class="container">
            <div class="row justify-content-end">



                <div class="col-2">
                    <div class="mb-3">
                        <label class="form-label">Rūšiuoti</label>
                        <select class="form-select" name="sort">
                            {{-- <option>default</option> --}}
                            {{-- @foreach($sortSelect as $value => $name)
                            <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-2">
                    <div class="mb-3">
                        <label class="form-label">Rodyti</label>
                        <select class="form-select" name="per_page">
                            {{-- <option>default</option> --}}
                            {{-- @foreach($perPageSelect as $value)
                            <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>

                            @endforeach --}}
                            {{-- </select>
                    </div>
                </div>

                <div class="col-2 ">
                    <div class=" head-buttons">
                        <button type="submit" class="btn btn-outline-primary mt-3" style="margin-right: 5px">Rodyti</button>
                        <a href="{{route('customers-index')}}" class="btn btn-outline-primary mt-3" style="color: #0dcaf0">Atnaujinti</a>



                    </div>
                </div>

            </div>
        </div> --}}


        {{-- </form> --}}




        {{-- @if($errors)
        @foreach ($errors->all() as $message)
        <div class="col-6">
            <div class="alert alert-danger m-4" role="alert">
                {{ $message }}
    </div>
</div>
@endforeach
@endif --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('back.common.cats')
        </div>


        <div class="col-9">
            <div class="card">

                <div class="card-header card-header-cats">
                    <h3><a href="{{route('hotels-index')}}">
                            All hotels</a></h3>
                </div>


                @forelse($hotels as $hotel)
                <div id="{{ $hotel['id'] }}" class="card card-list">

                    <div class="card-header-list">
                        <p class="card-title card-title-bold">{{$hotel->title}}***</p>

                        <p class="card-title">{{$hotel->hotelCountry->title}}</p>
                    </div>
                    <div class="card-body card-body-list">
                        <p>{{$hotel->startNice}} - {{$hotel->endNice}}</p>
                        {{-- <p>{{$hotel->start}} - {{$hotel->end}}</p> --}}



                        <p class="card-text">{{$hotel->duration}} nights</p>
                        <p style="font-weight: bold"> Price: {{$hotel->price}} eur</p>
                        <div class="smallimg">
                            @if($hotel->photo)
                            <img src="{{asset($hotel->photo)}}">
                            @else
                            <img src="{{asset('/hotels/no.jpg')}}">

                            @endif
                        </div>
                        <div class="buttons">
                            <a class="btn btn-outline-warning" href="{{route('hotels-show', $hotel)}}">Show</a>

                            <a class="btn btn-outline-success" href="{{route('hotels-edit', $hotel)}}">Edit</a>
                            @if(Auth::user()?->role == 'admin')

                            <form action="{{route('hotels-delete', $hotel)}}" method="post">
                                <button type="submit" class="btn btn-outline-danger btn-delete">Delete</button>

                                @csrf
                                @method('delete')
                            </form>
                            @endif
                        </div>


                    </div>
                </div>


                @empty
                <div class="list-group-item">No types yet</div>
                @endforelse


            </div>
            {{-- @if($perPageShow != 'visi')
        <div class="m-2">
            {{$customers->links()}}
            {{-- </div>
    @endif --}}
        </div>

    </div>

</div>



@endsection

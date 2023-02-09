@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">


            <div class="card-body">
                <div class="card-body">
                    <form action="{{route('update-cart')}}" method="post">
                        <ul class="list-group">
                            @forelse($cartList as $hotel)
                            <li class="list-group-item">
                                <div class="list-table cart d-flex">
                                    <div class="list-table__content">

                                        <div class="type"> {{$hotel->title}}***</div>

                                        <div class="type"> {{$hotel->hotelCountry->title}}</div>

                                        <div class="smallimg">
                                            @if($hotel->photo)
                                            <img src="{{asset($hotel->photo)}}">
                                            @endif
                                        </div>

                                        <div class="buy-btn d-flex">

                                            <input class="form-control input-buy" type="number" min="1" name="count[]" value="{{$hotel->count}}">

                                            <input type="hidden" name="ids[]" value="{{$hotel->id}}">
                                        </div>
                                        <div class="price"> {{$hotel->sum}} Eur</div>


                                    </div>
                                    <div class="list-table__buttons">
                                        <button type="submit" name="delete" value="{{$hotel->id}}" class="btn btn-outline-danger">Delete</button>
                                    </div>

                                </div>
                            </li>
                            @empty
                            <li class="list-group-item">Cart Empty</li>
                            @endforelse
                            <li class="list-group-item">
                                <button type="submit" class="btn btn-outline-success">Update cart</button>
                            </li>
                        </ul>
                        @csrf
                    </form>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <form action="{{route('make-order')}}" method="post">
                                <button type="submit" class="btn btn-outline-primary">Buy</button>
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

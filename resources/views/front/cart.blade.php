@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">


            <div class="card-body">

                <form action="{{route('update-cart')}}" method="post">
                    <ul class="list-group d-flex">
                        @forelse($cartList as $hotel)
                        <li class="list-group-item">
                            <div class="card cart d-flex">

                                <div class=" card-header card-header-hotel">


                                    <h3 class="type"> {{$hotel->title}}***</h3>

                                    <h5 class="type"> {{$hotel->hotelCountry->title}}</h5>
                                </div>


                                <div class="list-table__content mt-3">



                                    <div class="smallimg">
                                        @if($hotel->photo)
                                        <img src="{{asset($hotel->photo)}}">
                                        @endif
                                    </div>
                                    <div class="cart-right">
                                        <p class="card-text">{{$hotel->start}} - {{$hotel->end}}</p>

                                        <div class="buy-btn d-flex">


                                            <input class="form-control input-buy-cart" type="number" min="1" name="count[]" value="{{$hotel->count}}">
                                            <p class="cart-price"> {{$hotel->sum}} Eur</p>

                                            <input type="hidden" name="ids[]" value="{{$hotel->id}}">
                                        </div>
                                    </div>


                                </div>
                                <div class="cart-delete">
                                    <button type="submit" name="delete" value="{{$hotel->id}}" class="btn btn-outline-danger mt-2">Delete</button>
                                </div>


                            </div>

                        </li>
                        @empty
                        <li class="list-group-item">Cart Empty</li>
                        @endforelse
                        <li class="list-group-item cart-btn">

                            <button type="submit" class="btn btn-outline-success" style="text-align: center">Update cart</button>
                        </li>
                    </ul>
                    @csrf
                </form>
                <ul class="list-group">
                    <li class="list-group-item cart-btn">

                        <form action="{{route('make-order')}}" method="post">
                            <button type="submit" class="btn btn-outline-primary">Buy now</button>
                            @csrf
                        </form>
                    </li>
                </ul>

            </div>
            <a href="{{route('start')}}"><button type="submit" class="btn btn-outline-primary">Back</button>

        </div>
    </div>
</div>
</div>
@endsection

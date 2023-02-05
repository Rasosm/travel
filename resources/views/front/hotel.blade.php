 @extends('layouts.front')



 @section('content')
 @section('title', 'Hotel list')


 <div class="container">
     <div class="row justify-content-center">

         <div class="container">
             <div class="row justify-content-center">


                 <div class="col-8">

                     <div class="list-table">
                         <div class="card one-hotel" style="margin-bottom: 5px">


                             <div class="card-header card-header-hotel col-12">

                                 <h3 class="card-title card-title-hotel">{{$hotel->title}}**** </h3>

                                 <h3 class="card-title card-title-hotel"> {{$hotel->hotelCountry->title}}
                                 </h3>

                             </div>
                             @if($hotel->photo)
                             <div class="smallimg">

                                 @if($hotel->photo)
                                 <img class="img-hotel" src="{{asset($hotel->photo)}}">
                                 @endif
                             </div>

                             @endif

                             <div class="col-9">
                                 <div class="mb-3">
                                     <label class="form-label">Hotel description</label>
                                     <div>{{$hotel->desc}}</div>

                                 </div>
                             </div>
                             <div class="card-body">
                                 <p class="card-text">{{$hotel->duration}} nights</p>
                                 <p style="font-weight: bold"> Price: {{$hotel->price}} eur</p>

                             </div>



                             <div class="buy">
                                 {{-- <div class="price"> {{$hotel->price}}Eur</div> --}}
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


         </div>
     </div>
 </div>










 </div>
 </div>





 @endsection

 @extends('layouts.front')



 @section('content')
 @section('title', 'Hotel list')


 <div class="container">
     <div class="row justify-content-center">

         <div class="container">
             <div class="row justify-content-center">


                 <div class="col-12">

                     <div class="list-table">
                         <div class="card" style="margin-bottom: 5px">
                             <div class="smallimg">
                                 @if($hotel->photo)
                                 <img src="{{asset($hotel->photo)}}">
                                 @endif
                             </div>

                             <div class="card-header" style="display: inherit">
                                 <p class="card-title" style="font-size: 18px; font-weight: bold; line-height: 1.4">{{$hotel->title}}</p>
                                 <p class="card-title" style="margin-left: 7px;">{{$hotel->hotelCountry->title}}</p>
                             </div>
                             <div class="card-body">
                                 <p class="card-text">{{$hotel->duration}} nights</p>
                                 <p style="font-weight: bold"> Price: {{$hotel->price}} eur</p>

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


             </div>
         </div>
     </div>










 </div>
 </div>





 @endsection

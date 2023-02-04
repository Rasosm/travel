<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="card-header create">
        About hotel
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Country</label>
            {{$hotel->hotelCountry?->title}}
        </div>
        <div class="mb-3">
            <label class="form-label">Hotel</label>
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


</body>
</html>

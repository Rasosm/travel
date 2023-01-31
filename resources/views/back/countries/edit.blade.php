@extends('layouts.app')

@section('content')
@section('title', 'Edit Country')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    Edit Country
                </div>
                <div class="card-body">
                    <form action="{{route('countries-update', $country)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" name="country_title" class="form-control" value="{{$country->title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season</label>
                            <input type="text" name="country_season" class="form-control" value="{{$country->season}}">

                        </div>
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

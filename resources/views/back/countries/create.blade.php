@extends('layouts.app')

@section('content')
@section('title', 'New Country')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    Create new country
                </div>
                <div class="card-body">
                    <form action="{{route('countries-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" name="country_title" class="form-control" placeholder="country" value="{{old('country_title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season start</label>
                            <input type="date" name="country_season_start" class="form-control" placeholder="season start" value="{{old('country_season')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season end</label>
                            <input type="date" name="country_season_end" class="form-control" placeholder="season end" value="{{old('country_season')}}">
                        </div>
                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-info mt-4">Save</button>
                        </div>
                        @csrf

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

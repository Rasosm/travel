@extends('layouts.app')

@section('content')
@section('title', 'Country List')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3>All Countries</h3>
                </div>
                <div class="card-body flex">
                    <ul class="list-group">
                        @forelse($countries as $country)
                        <li class="list-group-item">

                            <div id="{{ $country['id'] }}" class="list-table d-flex" style="justify-content: space-between">

                                <div>
                                    <h5>{{$country->title}}</h5>
                                    {{-- <div class="count">({{$country->countryHotels()->count()}})
                                </div> --}}

                                <p>{{$country->season_start}} - {{$country->season_end}}</p>
                            </div>
                            @if(Auth::user()?->role == 'admin')

                            <div class="buttons mt-3" style="align-items: baseline">
                                <a href="{{route('countries-edit', $country)}}" class="btn btn-outline-success">Edit</a>
                                <form action="{{route('countries-delete', $country)}}" method="post">
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                            @endif
                </div>
                </li>
                @empty
                <li class="list-group-item">No countries yet</li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

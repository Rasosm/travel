@extends('layouts.app')

@section('content')
@section('title', 'Country List')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>All Countries</h3>
                </div>
                <div class="card-body flex">
                    <ul class="list-group">
                        @forelse($countries as $country)
                        <li class="list-group-item">

                            <div class="list-table flex">

                                <h5>{{$country->title}}</h5>
                                <p>{{$country->season_start}} - {{$country->season_end}}</p>

                                <div class="buttons">
                                    <a href="{{route('countries-edit', $country)}}" class="btn btn-outline-success">Edit</a>
                                    <form action="{{route('countries-delete', $country)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
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

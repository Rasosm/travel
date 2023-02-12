@inject('cats', 'App\Services\CatsService')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-cats">
                <div class="card-header card-header-cats">

                    <h3><a href="{{route('hotels-index')}}">

                            All countries</h3>

                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($cats->get() as $country)
                        <li class="list-group-item">
                            <div class="list-table cats">
                                <div class="list-table-carts">
                                    <a href="{{route('hotels-show-cats-hotels', $country)}}">
                                        <h5>
                                            {{$country->title}}
                                            <div class="count">({{$country->countryHotels()->count()}})</div>
                                        </h5>
                                    </a>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No types yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

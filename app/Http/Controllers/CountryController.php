<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all()->sortBy('title');
        return view('back.countries.index', [
            'countries' => $countries

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;
        $country->title = $request->country_title;
        $country->season_start = $request->country_season_start;
        $country->season_end = $request->country_season_end;
        
        $country->save();

        return redirect()->route('countries-index', ['#'.$country->id])->with('ok', 'Sveikinu, sėkmingai sukūrėte naują sąskaitą');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('back.countries.edit',[
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->title = $request->country_title;
        $country->season_start = $request->country_season_start;
        $country->season_end = $request->country_season_end;
        
        $country->save();

        return redirect()->route('countries-index')->with('ok', 'Sveikinu, sėkmingai sukūrėte naują sąskaitą');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        if(!$country->countryHotels()->count()){
            $country->delete();
            return redirect()->route('countries-index');
        }
        return redirect()->back()->with('not', 'You can not delete this country, because it has some hotels');
        
    }
}

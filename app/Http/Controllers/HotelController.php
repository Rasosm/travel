<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Services\CartService;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        // if($request->s){
        //     $s = explode(' ', $request->s);

        //     if ( count($s) == 1) {
        //         $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();

        //     }
        //     else {
        //         $hotels = Hotel::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
        //         ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
        //         ->get();
        //     }
        // }
        // if(!$request->s){
            $hotels = Hotel::all();
  
        // }
       

        $hotels = $hotels->map(function($t) {
            // $t->startNice = Carbon::parse($t->start)->format('Y.m.d');
            // $t->endNice = Carbon::parse($t->end)->format('Y.m.d');
            $t->startNice = Carbon::parse($t->start)->format('F j, Y');
            $t->endNice = Carbon::parse($t->end)->format('F j, Y');
            return $t;
        });


        return view('back.hotels.index', [
            'hotels' => $hotels,
            's' => $request->s ?? ''

        ]);
    }
    public function showCatHotels(Country $country)
    {
    $hotels = Hotel::where('country_id', $country->id)->get();

    return view('back.hotels.index', [
    'hotels' => $hotels
    ]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all()->sortBy('title');;
        return view('back.hotels.create', [
            'countries' => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
        $request->all(),
        [
        
        'hotel_title' => 'required|min:3|max:100|regex:/^([a-zA-ZąčęėįšųūžĄČĘĖĮŠŲŪŽ\s]+){3,}$/',
        'hotel_start' => 'required',
        'hotel_duration' => 'required|numeric|min:1|max:14',
        'hotel_price' => 'required|regex:/^[1-9]\d*(\.\d{1,2})?$/',

        ],
        [
            'hotel_title.required' => 'Please enter hotel name',
            'hotel_title.min' => 'Please enter at least 3 characters',
            'hotel_title.max' => 'Please enter correct hotel name. Hotel name has too many characters',
            'hotel_title.regex' => 'Please enter correct hotel name',
            'hotel_start.required' => 'Please enter date',
            'hotel_duration.required' => 'Please enter duration',
            'hotel_duration.numeric' => 'Please enter correct duration',
            'hotel_duration.min' => 'Travel duration can be at least 1 night',
            'hotel_duration.max' => 'Travel duration can not be more than 14 night',
            'hotel_price.required' => 'Please enter price',
            'hotel_price.regex' => 'Please enter correct price',
        ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $hotel = new Hotel;

         if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // $Image = Image::make($photo)->pixelate(12);
            // $Image->save(public_path().'/trucks/'.$file);

            if ($hotel->photo) {
                $hotel->deletePhoto();
            }
            $photo->move(public_path().'/hotels', $file);
            $hotel->photo = '/hotels/' . $file;
        }

        $start = Carbon::parse($request->hotel_start);
        $end = Carbon::parse($request->hotel_start)->addDays($request->hotel_duration);

        $hotel->country_id = $request->country_id;
        $hotel->title = $request->hotel_title;
        $hotel->start = $start;
        $hotel->end = $end;
        $hotel->duration = $request->hotel_duration;
        $hotel->price = $request->hotel_price;
        $hotel->desc = $request->hotel_desc;

        // Hotel::insert([
        //     'start' => $start,
        //     'end' => $end,
        // ]);
        // dump($hotel->hotelCountry->season_start);

        // if (($hotel->hotelCountry->season_start < $request->hotel_start) || ($hotel->hotelCountry->season_end > $request->hotel_start)) {
        //     $request->flash();
        //     return redirect()->back()->with('not', 'Please enter correct dates. In ' . ' ' . $hotel->hotelCountry->title . ' season is from ' . $hotel->hotelCountry->season_start . ' to ' . $hotel->hotelCountry->season_end);
        // }
        
        $countryStart = $hotel->hotelCountry->season_start;
        $countryEnd = $hotel->hotelCountry->season_end;
        $hotelStart = $request->hotel_start;
        $hotelEnd = $request->hotel_end;

        
        if (($countryStart > $hotelStart) || ($countryEnd < $hotelEnd) || ($countryEnd < $end)) {
            $request->flash();
            return redirect()->back()->with('not', 'Please enter correct dates. In ' . ' ' . $hotel->hotelCountry->title . ' season is from ' . $hotel->hotelCountry->season_start . ' to ' . $hotel->hotelCountry->season_end);
         }

        else {

        $hotel->save();
        return redirect()->route('hotels-index', ['#'.$hotel->id])->with('ok', 'Hotel succesfully added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        return view('back.hotels.show',[
            'hotel' => $hotel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $countries = Country::all();
        return view('back.hotels.edit',[
            'hotel' => $hotel,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        if ($request->delete_photo) {
            $hotel->deletePhoto();
            return redirect()->back()->with('ok', 'Photo was deleted');
        }

        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // $Image = Image::make($photo)->pixelate(12);
            // $Image->save(public_path().'/trucks/'.$file);

            if ($hotel->photo) {
                $hotel->deletePhoto();
            }
            $photo->move(public_path().'/hotels', $file);
            $hotel->photo = '/hotels/' . $file;
        }
        

        $hotel->country_id = $request->country_id;
        $hotel->title = $request->hotel_title;
        $hotel->start = $request->start;
        $hotel->end = $request->end;
        $hotel->duration = $request->hotel_duration;
        $hotel->price = $request->hotel_price;
        $hotel->desc = $request->hotel_desc;

        $hotel->save();
        return redirect()->route('hotels-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->back()->with('ok', 'Hotel was deleted');
    }

    public function pdf(Hotel $hotel)
    {
        $pdf = Pdf::loadView('back.hotels.pdf', ['hotel' => $hotel]);
        return $pdf->download($hotel->title.'.pdf');
    }


}

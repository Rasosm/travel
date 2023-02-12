<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Services\CartService;

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

        $hotel->save();
        return redirect()->route('hotels-index', ['#'.$hotel->id]);
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
        return redirect()->back()->with('ok', 'Drink was deleted');
    }

    public function pdf(Hotel $hotel)
    {
        $pdf = Pdf::loadView('back.hotels.pdf', ['hotel' => $hotel]);
        return $pdf->download($hotel->title.'.pdf');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class FrontController extends Controller
{
   public function home()
    {
        $hotels = Hotel::paginate(8);

        return view('front.home', [
            'hotels' => $hotels
        ]);
    }
    public function showHotel(Hotel $hotel)
    {
        return view('front.hotel', [
            'hotel' => $hotel
        ]);
    }
    public function addToCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $id = (int) $request->product;
        $count = (int) $request->count;
        if (isset($cart[$id])) {
            $cart[$id] += $count;
        }
        else {
            $cart[$id] = $count;
        }
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }
}

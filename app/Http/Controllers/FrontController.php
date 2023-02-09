<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;
use App\Services\CartService;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class FrontController extends Controller
{
   public function home(Request $request)
    {
        $perPageShow = in_array($request->per_page, Hotel::PER_PAGE) ? $request->per_page : '8';
       if(!$request->s) {
            if($request->country_id && $request->country_id != 'all'){
                $hotels = Hotel::where('country_id', $request->country_id);
            }
            else {
                $hotels = Hotel::where('id', '>', 0);
            }
                
          
            
            $hotels = match($request->sort ?? '') {
                    'asc_title' => $hotels->orderBy('title'),
                    'desc_title' => $hotels->orderBy('title', 'desc'),
                    'asc_price' => $hotels->orderBy('price'),
                    'desc_price' => $hotels->orderBy('price', 'desc'),
                    default => $hotels
            };

            if( $perPageShow == 'all'){
                    $hotels = $hotels->get();
                }else{
                    $hotels = $hotels->paginate($perPageShow)->withQueryString();
                }
        }
        else{
            $s = explode(' ', $request->s);

            if ( count($s) == 1) {
                $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->paginate($perPageShow)->withQueryString();
            }
            else {
                $hotels = Hotel::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->paginate($perPageShow)->withQueryString();
            }
        }

            $countries = Country::all();

        return view('front.home', [
            'hotels' => $hotels,
            'sortSelect' => Hotel::SORT,
            'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Hotel::PER_PAGE,
            'perPageShow' => $perPageShow,
            'countries' => $countries,
            'countryShow' => $request->country_id ? $request->country_id : '',
            's' => $request->s ?? ''
        ]);
    }
    public function showHotel(Hotel $hotel)
    {
        return view('front.hotel', [
            'hotel' => $hotel
        ]);
    }
    public function addToCart(Request $request, CartService $cart)
    {
        $id = (int) $request->product;
        $count = (int) $request->count;
        $cart->add($id, $count);
        return redirect()->back();
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list
        ]);
    }

    public function updateCart(Request $request, CartService $cart)
    {
       if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect()->back();
    }

    public function makeOrder(CartService $cart)
    {
        $order = new Order;

        $order->user_id = Auth::user()->id;

        $order->order_json = json_encode($cart->order());

        $order->save();

        $cart->empty();

        return redirect()->route('start');
    }

}

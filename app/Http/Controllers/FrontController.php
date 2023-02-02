<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class FrontController extends Controller
{
   public function home()
    {
        $hotels = Hotel::paginate(6);

        return view('front.home', [
            'hotels' => $hotels
        ]);
    }
}

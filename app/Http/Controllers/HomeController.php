<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\Item;
use App\Models\Price;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $locations = Location::all();
        $items = Item::all();
        $prices = Price::where('user_id', auth()->id())->orderBy('created_at', 'desc')->take(10)->get();
        return view('home', compact('locations', 'items', 'prices'));
    }
}

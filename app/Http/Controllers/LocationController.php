<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\Price;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        Location::create($request->all());
        return back();
    }

    public function destroy(Location $location)
    {
        if(Price::where('location_id',$location->id)->exists())
        {
            // logic delete
            $location->delete();
        }
        else
        {
            // physic delete
            $location->forceDelete();
        }
        
        return back();
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $location->update($request->only('name'));
        return redirect('/locations');
    }
}

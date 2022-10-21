<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Price;
use App\Models\Item;

use App\Exports\PricesExport;
use Maatwebsite\Excel\Facades\Excel;

class PriceController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'location_id' => 'required',
            'item_id' => 'required'
        ];

        $messages = [
            'location_id.required' => 'Wrong location',
            'item_id.required' => 'Wrong item',
        ];
        
        $this->validate($request, $rules, $messages);
        
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Price::create($data);

        return back();
    }

    public function destroy(Price $price)
    {
        $price->delete();
        return back();
    }

    public function export(Item $item) 
    {
        $fileName = "prices".$item->id.".xlsx";
        $export = new PricesExport($item->id);
        return Excel::download($export, $fileName);
    }
}

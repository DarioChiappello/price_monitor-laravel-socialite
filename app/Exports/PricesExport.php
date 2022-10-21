<?php

namespace App\Exports;

use App\Models\Price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PricesExport implements FromCollection, WithHeadings, WithMapping
{
    private $itemId;
    
    public function __construct($itemId)
    {
        $this->itemId = $itemId;
    }
    
    public function collection()
    {
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();
        
        return Price::with('location','item','user')
        ->where('item_id',$this->itemId)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get([
            'location_id',
            'item_id',
            'user_id',
            'value',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'Location',
            'Item',
            'User',
            'Value',
            'Date',
        ];
    }

    public function map($price): array
    {
        return [
            $price->location->name,
            $price->item->name,
            $price->user->name,
            $price->value,
            $price->created_at
        ];
    }
}
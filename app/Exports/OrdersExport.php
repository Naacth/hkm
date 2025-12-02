<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Total Amount',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
}

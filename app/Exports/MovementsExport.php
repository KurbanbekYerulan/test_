<?php

namespace App\Exports;

use App\Models\Movement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class MovementsExport extends CustomValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder
{
    protected $groupId;
    protected $productId;

    public function __construct($groupId = null, $productId = null)
    {
        $this->groupId = $groupId;
        $this->productId = $productId;
    }

    public function collection()
    {
        return Movement::with('product.group')
            ->when($this->groupId, function ($query) {
                return $query->whereHas('product', function ($query) {
                    $query->where('group_id', $this->groupId);
                });
            })
            ->when($this->productId, function ($query) {
                return $query->where('product_id', $this->productId);
            })
            ->get()
            ->map(function ($movement) {
                return [
                    'Product Name' => $movement->product->name,
                    'Group Name' => $movement->product->group->name,
                    'Quantity' => $movement->quantity,
                    'From Warehouse' => $movement->from_warehouse,
                    'To Warehouse' => $movement->to_warehouse,
                    'Moved At' => $movement->moved_at,
                    'Type' => $movement->product->type,
                    'Weight' => $movement->product->weight,
                ];
            });
    }


    public function headings(): array
    {
        return [
            'Product Name',
            'Group Name',
            'Quantity',
            'From Warehouse',
            'To Warehouse',
            'Moved At',
            'Type',
            'Weight'
        ];
    }

}


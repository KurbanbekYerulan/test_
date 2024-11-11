<?php

namespace App\Http\Controllers\API;

use App\Models\Movement;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MovementsExport;
use SimpleXMLElement;

class MovementController extends Controller
{
    public function index(Request $request)
    {
        $movements = Movement::with('product.group')
            ->when($request->group_id, function ($query, $groupId) {
                return $query->whereHas('product', function ($query) use ($groupId) {
                    $query->where('group_id', $groupId);
                });
            })
            ->when($request->product_id, function ($query, $productId) {
                return $query->where('product_id', $productId);
            })
            ->get();

        return response()->json($movements);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'from_warehouse' => 'required|string',
            'to_warehouse' => 'required|string',
        ]);

        $movement = Movement::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'from_warehouse' => $request->from_warehouse,
            'to_warehouse' => $request->to_warehouse,
            'moved_by' => auth()->id(),
        ]);

        return response()->json($movement, 201);
    }

    public function exportToExcel()
    {
        return Excel::download(new MovementsExport, 'movements.xlsx');
    }

    public function exportToXml(Request $request)
    {
        $movements = Movement::with('product.group')
            ->when($request->group_id, function ($query, $groupId) {
                return $query->whereHas('product', function ($query) use ($groupId) {
                    $query->where('group_id', $groupId);
                });
            })
            ->when($request->product_id, function ($query, $productId) {
                return $query->where('product_id', $productId);
            })
            ->get();

        $xml = new SimpleXMLElement('<movements/>');
        foreach ($movements as $movement) {
            $entry = $xml->addChild('movement');
            $entry->addChild('product_name', $movement->product->name);
            $entry->addChild('group_name', $movement->product->group->name);
            $entry->addChild('quantity', $movement->quantity);
            $entry->addChild('from_warehouse', $movement->from_warehouse);
            $entry->addChild('to_warehouse', $movement->to_warehouse);
            $entry->addChild('moved_at', $movement->moved_at);

            $product = $entry->addChild('product_parameters');
            $product->addChild('type', $movement->product->type);
            $product->addChild('weight', $movement->product->weight);
        }

        return response($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename="movement_report.xml"');
    }

}


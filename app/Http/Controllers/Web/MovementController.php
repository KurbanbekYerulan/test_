<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function showDocument($id)
    {
        $movement = Movement::with('product')->findOrFail($id);
        return view('movements.document', compact('movement'));
    }

    public function editDocument(Request $request, $id)
    {
        $request->validate([
            'admin_password' => 'required|string',
            'quantity' => 'required|integer',
            'from_warehouse' => 'required|string',
            'to_warehouse' => 'required|string',
        ]);

        if ($request->admin_password !== config('app.admin_password')) {
            return redirect()->back()->withErrors(['admin_password' => 'Invalid password']);
        }


        $movement = Movement::findOrFail($id);
        $movement->update([
            'quantity' => $request->quantity,
            'from_warehouse' => $request->from_warehouse,
            'to_warehouse' => $request->to_warehouse,
        ]);

        return redirect()->route('movements.document', $id)->with('success', 'Document updated successfully');
    }

    public function report(Request $request)
    {
        $groups = ProductGroup::all();
        $products = Product::all();

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

        return view('movements.report', compact('movements', 'groups', 'products'));
    }
}

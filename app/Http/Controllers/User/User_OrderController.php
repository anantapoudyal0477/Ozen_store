<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class User_OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $orders = Order::with([
            'orderDetail',
            'orderItems.product',   // ✅ for glasses/products
            'orderItems.eyeLens',   // ✅ ADD THIS (VERY IMPORTANT)
            'prescriptions.eyes'    // for prescription glasses
        ])
        ->where('user_id', $userId)
        ->latest()
        ->get();

        return $this->renderUserViewPage(
            'User.Orders.index',
            'order',
            ["ListOfOrder" => $orders]
        );
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $orderNumber)
    {
        $deleted = Order::where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->delete();

        if ($deleted) {
            return response()->json([
                'message' => 'Order deleted successfully.'
            ]);
        }

        return response()->json([
            'message' => 'Failed to delete order.'
        ], 500);
    }
}

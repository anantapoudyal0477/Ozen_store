<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\order as ModelsOrder;
use App\Models\PrescriptionGlasses;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
class User_OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        echo Auth::user()->id;

        $userId = Auth::id();
        $orders = Order::with([
            'orderDetail',
            'orderItems.product', // Load product details
            'prescriptions.eyes'
        ])->where('user_id', $userId)->latest()->get();

        // dd($order);
        return $this->renderUserViewPage('User.orders.index','order',["ListOfOrder"=>$orders]);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $orderNumber)
    {
        // Delete all orders with the given order_number for this user
        $deleted = Order::where('user_id', Auth::user()->id)
            ->where('order_number', $orderNumber)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Order deleted successfully.']);
        }


        return response()->json(['message' => 'Failed to delete order.'], 500);
    }
}

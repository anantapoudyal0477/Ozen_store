<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\PrescriptionGlasses;
use App\Models\Prescriptions;
use App\Http\Controllers\Controller;

class Admin_OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $orders = Order::with('orderDetail','user','orderItems.product','prescriptions')
        ->latest()
        ->get();
    // dd($ListOfOrders);


    return $this->renderAdminViewPage(
        'Administrator.Orders.index',
        'Orders Management',
        [
            "ListOfOrders" => $orders,        ]
    );
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
public function show($id)
{
       $order = Order::with([
        'orderDetail',
        'user',
        'orderItems.product',
        'prescriptions.glasses'
    ])->findOrFail($id);

    // dd($order);
    return response()->json($order);
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
    // app/Http/Controllers/Admin_OrdersController.php

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:ready,cancel,canceled'
    ]);

    $order = order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return response()->json([
        'success' => true,
        'message' => "Order #{$order->order_number} status updated to {$order->status}"
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

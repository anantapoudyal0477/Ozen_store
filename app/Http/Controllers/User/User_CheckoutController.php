<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\prescriptions;
use \App\Models\UserDetail;


use App\Models\PrescriptionGlasses;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class User_CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    $userId = Auth::guard('users')->id();
    $cartItems = json_decode($request->cart_items, true);
    
    if (empty($cartItems)) {
        return response()->json([
            'success' => false,
            'message' => 'Cart is empty'
        ], 400);
    }
    
    // Get user details from user_details table
    $userDetail = UserDetail::where('user_id', $userId)->first();
    if (!$userDetail) {
        return response()->json([
            'success' => false,
            'message' => 'User details not found. Please update your profile.'
        ], 422);
    }
    
    DB::beginTransaction();

    try {
       $orderNumber = 'ORD-' . now()->format('Ymd-His') . '-' . strtoupper(uniqid());


        // 1️⃣ Create Order (PENDING)
        $order = Order::create([
            'user_id' => $userId,
            'order_number' => $orderNumber,
            'quantity' => 0,
            'total_price' => 0,
            'status' => 'pending'
        ]);

        $grandTotal = 0;
        $totalQty = 0;

        foreach ($cartItems as $item) {
            // Product validation
            $product = Products::where('id', $item['product_id'])->lockForUpdate()->first();
            if (!$product) throw new \Exception("Product not found (ID: {$item['product_id']})");
            if ($item['qty'] <= 0) throw new \Exception("Invalid quantity for {$product->product_name}");
            if ($product->product_stock < $item['qty']) throw new \Exception("Insufficient stock for {$product->product_name}");

            // Price check
            $backendItemTotal = $product->product_price * $item['qty'];
            if ((float)$item['total'] !== (float)$backendItemTotal) throw new \Exception("Price mismatch for {$product->product_name}");

            // Create OrderItem
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['qty'],
                'isPrescription' => !empty($item['prescription_details']),
            ]);

            // Deduct stock
            $product->decrement('product_stock', $item['qty']);

            $grandTotal += $backendItemTotal;
            $totalQty += $item['qty'];

            // Handle prescription
            if (!empty($item['prescription_details'])) {
                $data = [];
                foreach ($item['prescription_details'] as $row) $data = array_merge($data, $row);

                $prescription = prescriptions::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'user_id' => $userId,
                    'pd' => $data['pd'] ?? null,
                ]);

                PrescriptionGlasses::create([
                    'prescription_id' => $prescription->id,
                    'eye' => 'left',
                    'sphere' => $data['left_sphere'] ?? null,
                    'cylinder' => $data['left_cylinder'] ?? null,
                    'axis' => $data['left_axis'] ?? null,
                ]);

                PrescriptionGlasses::create([
                    'prescription_id' => $prescription->id,
                    'eye' => 'right',
                    'sphere' => $data['right_sphere'] ?? null,
                    'cylinder' => $data['right_cylinder'] ?? null,
                    'axis' => $data['right_axis'] ?? null,
                ]);
            }
        }

        // Update order totals
        $order->update([
            'quantity' => $totalQty,
            'total_price' => $grandTotal
        ]);

        // Save customer details from user_details table
        OrderDetail::create([
            'order_id' => $order->id,
            'full_name' => $userDetail->full_name,
            'email' => $userDetail->email,
            'phone' => $userDetail->phone,
            'address' => $userDetail->address,
            'city' => $userDetail->city,
            'payment_method' => $request->payment_method ?? 'cash',
        ]);

        DB::commit();
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'order_no' => $order->order_number,
            'redirect_url'=>route("User.payment.index",$order->order_number)
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 422);
    }
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
    public function destroy(string $id)
    {
        //
    }
}

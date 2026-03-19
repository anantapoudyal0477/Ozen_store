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

    // ✅ Merge duplicate products
    $cartItems = collect($cartItems)
        ->groupBy('product_id')
        ->map(function ($items) {
            $first = $items->first();

            return [
                'product_id' => $first['product_id'],
                'qty' => $items->sum('qty'),
                'total' => $items->sum('total'),
                'prescription_details' => $first['prescription_details'] ?? null
            ];
        })
        ->values()
        ->toArray();

    $userDetail = UserDetail::where('user_id', $userId)->first();

    if (!$userDetail) {
        return response()->json([
            'success' => false,
            'message' => 'User details not found.'
        ], 422);
    }

    DB::beginTransaction();

    try {
        $orderNumber = 'ORD-' . now()->format('Ymd-His') . '-' . strtoupper(uniqid());

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

            $product = Products::where('id', $item['product_id'])
                ->lockForUpdate()
                ->first();

            if (!$product) throw new \Exception("Product not found");
            if ($item['qty'] <= 0) throw new \Exception("Invalid quantity");
            if ($product->product_stock < $item['qty']) throw new \Exception("Insufficient stock");

            $backendTotal = $product->product_price * $item['qty'];

            if ((float)$item['total'] !== (float)$backendTotal) {
                throw new \Exception("Price mismatch");
            }

            // ✅ Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['qty'],
                'isPrescription' => !empty($item['prescription_details']),
            ]);

            $product->decrement('product_stock', $item['qty']);

            $grandTotal += $backendTotal;
            $totalQty += $item['qty'];

            // ✅ Handle prescription
            if (!empty($item['prescription_details'])) {

                $data = [];
                foreach ($item['prescription_details'] as $row) {
                    $data = array_merge($data, $row);
                }

                // ✅ FIX: prevent duplicate prescription
                $prescription = prescriptions::updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'user_id' => $userId,
                    ],
                    [
                        'pd' => $data['pd'] ?? null,
                    ]
                );

                // ✅ FIX: prevent duplicate glasses
                PrescriptionGlasses::updateOrCreate(
                    [
                        'prescription_id' => $prescription->id,
                        'eye' => 'left',
                    ],
                    [
                        'sphere' => $data['left_sphere'] ?? null,
                        'cylinder' => $data['left_cylinder'] ?? null,
                        'axis' => $data['left_axis'] ?? null,
                    ]
                );

                PrescriptionGlasses::updateOrCreate(
                    [
                        'prescription_id' => $prescription->id,
                        'eye' => 'right',
                    ],
                    [
                        'sphere' => $data['right_sphere'] ?? null,
                        'cylinder' => $data['right_cylinder'] ?? null,
                        'axis' => $data['right_axis'] ?? null,
                    ]
                );
            }
        }

        $order->update([
            'quantity' => $totalQty,
            'total_price' => $grandTotal
        ]);

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
            'redirect_url' => route('User.payment.index', [
                'order_no' => $order->order_number
            ])
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

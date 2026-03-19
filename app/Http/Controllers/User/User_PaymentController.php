<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class User_PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index($order_no)
{
    $order = Order::with([
            'orderDetail',
            'orderItems.product',
            'prescriptions.glasses'
        ])
        ->where('order_number', $order_no)
        ->where('user_id', Auth::id())
        ->where('status', 'pending')
        ->firstOrFail();

    $productDetails = [];
    foreach($order->orderItems as $item){
        $itemPrice = $item->product->product_price * $item->quantity;
        $vatAmount = ($itemPrice*13)/100;
        $total = $itemPrice + $vatAmount;

        $productDetails[] = [
            'identity' => (string)$item->product->id,
            'name' => $item->product->product_name,
            'total_price' => $total,
            'quantity' => $item->quantity,
            'unit_price' => $item->product->product_price,
        ];
    }

    $paymentPayload = [
        'return_url'         => route('User.Payment.index', $order->order_number),
        'website_url'        => config('app.url'),
        'amount'             => $order->total_price,
        'purchase_order_id'  => $order->order_number,
        'purchase_order_name'=> "Order #".$order->order_number,
        'customer_info'      => [
            'name'  => $order->orderDetail->full_name,
            'email' => $order->orderDetail->email,
            'phone' => $order->orderDetail->phone,
        ],
        'amount_breakdown'   => [
            ['label' => 'Subtotal', 'amount' => $order->total_price / 1.13],
            ['label' => 'VAT 13%', 'amount' => $order->total_price - ($order->total_price / 1.13)]
        ],
        'product_details'    => $productDetails,
        'merchant_username'  => config('services.payment.merchant_username'),
        'merchant_extra'     => "Optional extra data"
    ];

    return $this->renderUserViewPage(
        "User.payment.index",
        'payment',
        [
            'order' => $order,
            'order_number' => $order->order_number,
            'order_detail' => $order->orderDetail,
            'order_items' => $order->orderItems,
            'prescriptions'=> $order->prescriptions,
            'amount' => $order->total_price,
            'quantity' => $order->quantity,
            'paymentPayload' => $paymentPayload, // ✅ pass to Blade
        ]
    );
}

// app/Http/Controllers/User/PaymentController.php

public function showOrderJson($order_no)
{
    $order = Order::with([
        'orderDetail',
        'orderItems.product',
        'prescriptions.glasses'
    ])
    ->where('order_number', $order_no)
    ->where('user_id', Auth::id())
    ->firstOrFail();

    // Calculate actual price, VAT 13%, total
    $actualPriceSum = 0;
    $vatAmount = 0;
    $productDetails = [];

    foreach($order->orderItems as $item){
        $itemPrice = $item->product->product_price * $item->quantity;
        $itemVat = ($itemPrice * 13)/100;
        $total = $itemPrice + $itemVat;

        $actualPriceSum += $itemPrice;
        $vatAmount += $itemVat;

        $productDetails[] = [
            "identity"    => (string)$item->product_id,
            "name"        => $item->product->product_name,
            "unit_price"  => $item->product->product_price,
            "quantity"    => $item->quantity,
            "total_price" => $total
        ];
    }

    $payload = [
        "return_url"          => route('User.Payment.index', $order->order_number),
        "website_url"         => url('/'),
        "amount"              => $actualPriceSum + $vatAmount,
        "purchase_order_id"   => $order->order_number,
        "purchase_order_name" => "Order #".$order->order_number,
        "customer_info"       => [
            "name"  => $order->orderDetail->full_name ?? "",
            "email" => $order->orderDetail->email ?? "",
            "phone" => $order->orderDetail->phone ?? ""
        ],
        "amount_breakdown"    => [
            ["label" => "Mark Price", "amount" => $actualPriceSum],
            ["label" => "VAT", "amount" => $vatAmount]
        ],
        "product_details"     => $productDetails,
        "merchant_username"   => "merchant_name",
        "merchant_extra"      => "merchant_extra"
    ];

    return $this->renderUserViewPage('User.Payment.json','test payload', compact('payload'));
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
    public function destroy(string $id)
    {
        //
    }
}

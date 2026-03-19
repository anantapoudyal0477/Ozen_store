<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class User_CartController extends Controller
{
    // Show cart
    public function index()
    {
        $cartItems = session()->get('cart', []);

        return $this->renderUserViewPage('User.Cart.index', 'Cart', [
            'cartData' => $cartItems
        ]);
    }

    // Add single normal product
    public function store(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:100'
        ]);

        $product = Products::findOrFail($id);
        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        // Limit cart size
        if (count($cart) >= 50) {
            return redirect()->route('User.Cart.index')->with('error', 'Cart item limit reached!');
        }

        // Generate secure unique cart ID
        $cartId = Str::uuid()->toString();

        $cart[$cartId] = [
            'cart_id' => $cartId,
            'id' => $product->id,
            'name' => htmlspecialchars($product->product_name),
            'price' => $product->product_price,
            'image' => $product->product_image,
            'qty' => $quantity,
            'type' => 'regular',
            'prescription_details' => null
        ];

        session()->put('cart', $cart);

        return redirect()->route('User.Cart.index')->with('success', 'Product added to cart!');
    }

    // Add multiple or prescription products
    public function storeMultipleItems(Request $request)
    {
        $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*.id' => 'required|integer|exists:products,id',
            'selected_products.*.qty' => 'required|integer|min:1|max:100',
            'EyeData' => 'nullable|array',
        ]);

        $cart = session()->get('cart', []);

        // Sanitize prescription data
  $eyeData = $request->input('EyeData', null);

if ($eyeData) {
    $sanitizeArray = function($data) use (&$sanitizeArray) {
        if (is_array($data)) {
            return array_map($sanitizeArray, $data);
        }
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    };

    $eyeData = $sanitizeArray($eyeData);
}


        foreach ($request->selected_products as $item) {
            $product = Products::findOrFail($item['id']);
            $quantity = $item['qty'] ?? 1;

            // Secure unique cart ID
            $cartId = Str::uuid()->toString();

            $cart[$cartId] = [
                'cart_id' => $cartId,
                'id' => $product->id,
                'name' => htmlspecialchars($product->product_name),
                'price' => $product->product_price,
                'qty' => $quantity,
                'type' => 'prescription',
                'prescription_details' => $eyeData,
                'image' => $product->product_image
            ];
        }

        session()->put('cart', $cart);

        // dd($cart);
        return response()->json([
            'success' => true,
            'message' => 'Products added to cart successfully.'
        ]);
    }

    // Update cart item quantity
    public function update(Request $request, $cart_id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$cart_id])) {
            return response()->json(['success' => false, 'message' => 'Invalid cart item'], 404);
        }

        $cart[$cart_id]['qty'] = $request->quantity;
        session()->put('cart', $cart);

        // Recalculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }
        $tax = $subtotal * 0.13;
        $total = $subtotal + $tax;

        return response()->json([
            'success' => true,
            'cart_id' => $cart_id,
            'price' => $cart[$cart_id]['price'],
            'cartSummary' => [
                'subtotal' => round($subtotal, 2),
                'tax' => round($tax, 2),
                'total' => round($total, 2)
            ]
        ]);
    }

    // Remove cart item
    public function destroy($cartId)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$cartId])) {
            return response()->json(['success' => false, 'message' => 'Invalid cart item'], 404);
        }

        unset($cart[$cartId]);
        session()->put('cart', $cart);

        // Recalculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }
        $tax = $subtotal * 0.13;
        $total = $subtotal + $tax;

        return response()->json([
            'success' => true,
            'cart_id' => $cartId,
            'cartSummary' => [
                'subtotal' => round($subtotal, 2),
                'tax' => round($tax, 2),
                'total' => round($total, 2)
            ]
        ]);
    }
// Clear entire cart
public function clear()
{
    session()->forget('cart');

    return response()->json([
        'success' => true,
        'message' => 'Cart cleared successfully.',
        'cartSummary' => [
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0
        ]
    ]);
}

    // Count items
    public function count()
    {
        $cart = session()->get('cart', []);
        return response()->json(['count' => count($cart)], 200);
    }
}

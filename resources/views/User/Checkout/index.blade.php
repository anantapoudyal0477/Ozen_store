@extends('user.user-layout-page')

@section('title', $pageTitle ?? 'Checkout')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Checkout</h1>

    @include('User.Components.Messages.Error_Messages')
    @include('User.Components.Messages.Success_Messages')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Cart Items Summary -->
        <div class="lg:col-span-2 bg-white shadow-lg rounded-lg p-6 border">
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border text-left">Product</th>
                            <th class="p-3 border text-center">Price</th>
                            <th class="p-3 border text-center">Qty</th>
                            <th class="p-3 border text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($cartItems as $item)
                            @php
                                $itemTotal = $item['price'] * $item['qty'];
                                $subtotal += $itemTotal;
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 border flex items-center space-x-3">
                                    <img src="{{ asset($item['image']) }}" class="w-14 h-14 object-cover rounded">
                                    <span>{{ $item['name'] }}</span>
                                </td>
                                <td class="p-3 border text-center">${{ number_format($item['price'], 2) }}</td>
                                <td class="p-3 border text-center">{{ $item['qty'] }}</td>
                                <td class="p-3 border text-right font-bold">${{ number_format($itemTotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Billing & Total -->
        <div class="bg-white shadow-lg rounded-lg p-6 border">
            <h2 class="text-xl font-semibold mb-4">Billing Details</h2>

            <form action="{{ route('User.checkout.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" name="name" required
                           class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" required
                           class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Address</label>
                    <textarea name="address" required rows="3"
                              class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>

                @php
                    $tax = $subtotal * 0.13;
                    $total = $subtotal + $tax;
                @endphp

                <div class="border-t pt-4 mt-4 space-y-1 text-gray-800">
                    <p class="flex justify-between"><span>Subtotal:</span> <span>${{ number_format($subtotal, 2) }}</span></p>
                    <p class="flex justify-between"><span>Tax (13%):</span> <span>${{ number_format($tax, 2) }}</span></p>
                    <p class="flex justify-between text-xl font-bold"><span>Total:</span> <span>${{ number_format($total, 2) }}</span></p>
                </div>

                <button type="submit"
                    class="w-full mt-5 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow-lg transition">
                    Place Order
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

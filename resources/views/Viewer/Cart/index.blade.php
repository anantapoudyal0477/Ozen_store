@extends('index')

@section('title', $pageTitle ?? 'Cart')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @include('Viewer.Components.Messages.Error_Messages')
        @include('Viewer.Components.Messages.Success_Messages')

        <h1 class="text-3xl font-bold mb-6 text-center">Your Shopping Cart</h1>

        @if(!empty($cartData) && count($cartData) > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @php $sum = 0; @endphp
                @foreach ($cartData as $item)
                    @php
                        $itemTotal = (float) $item['price'] * (int) $item['qty'];
                        $sum += $itemTotal;
                    @endphp
                    <div class="bg-white border rounded-lg shadow p-6 flex flex-col justify-between">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Product ID: {{ e($item['id']) }}</p>
                            <h2 class="text-xl font-semibold mb-2">{{ e($item['name']) }}</h2>
                            <p class="text-gray-700 mb-1">Price: <span
                                    class="font-bold">${{ number_format((float) $item['price'], 2) }}</span></p>
                            <p class="text-gray-700 mb-1">Quantity: <span class="font-medium">{{ (int) $item['qty'] }}</span></p>
                            <p class="text-gray-900 font-bold mt-2">Total:
                                ${{ number_format((float) $item['price'] * (int) $item['qty'], 2) }}</p>

                        </div>

                        <form action="{{ route('Cart.delete', $item['id']) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="cart-item-remove-btn"
                                class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition-colors">
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div>
                <div class="mt-6 text-right text-xl font-bold text-gray-800">
                    @php
                        $subtotal = (float) $sum;
                        $tax = $subtotal * 0.13; // 13% tax
                        $total = $subtotal + $tax;
                    @endphp

                    <p>Sub-Total: ${{ number_format($subtotal, 2) }}</p>
                    <p>Tax (13%): ${{ number_format($tax, 2) }}</p>
                    <p>Total: ${{ number_format($total, 2) }}</p>
                </div>

            </div>
        @else
            <div class="text-center text-gray-600 mt-12 text-lg">
                Your cart is empty.
            </div>
        @endif


    </div>
</script>
@endsection

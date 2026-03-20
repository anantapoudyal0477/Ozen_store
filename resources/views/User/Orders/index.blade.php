@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Your Orders')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-12 text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-3">
                Your Orders
            </h1>
            <p class="text-gray-600 text-lg">Track and manage all your purchases</p>
        </div>

        @forelse($ListOfOrder as $order)
            <div class="mb-8 bg-white rounded-2xl shadow-lg overflow-hidden">

                <!-- HEADER -->
                <div class="bg-blue-600 px-6 py-5 text-white flex justify-between">
                    <div>
                        <p class="text-sm">Order #{{ $order->order_number }}</p>
                        <p class="text-lg font-bold">{{ ucfirst($order->status) }}</p>
                    </div>
                    <div>
                        <p>Total</p>
                        <p class="text-xl font-bold">${{ number_format($order->total_price, 2) }}</p>
                    </div>
                </div>

                <!-- ITEMS -->
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Prescription</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($order->orderItems ?? [] as $idx => $item)

                                @php
                                    $product = $item->product ?? null;

                                    // SAFE prescription fetch
                                    $prescription = $order->prescriptions
                                        ->where('product_id', $item->product_id)
                                        ->first();

                                    // HANDLE JSON OR BOOLEAN
                                    $isPrescription = false;

                                    if (is_string($item->isPrescription)) {
                                        $decoded = json_decode($item->isPrescription, true);
                                        $isPrescription = $decoded ? true : false;
                                    } else {
                                        $isPrescription = (bool) $item->isPrescription;
                                    }
                                @endphp

                                <tr class="border-b">
                                    <td>{{ $idx + 1 }}</td>

                                    <td>
                                        {{ $product->product_name ?? 'N/A' }}
                                    </td>

                                    <td>{{ $item->quantity }}</td>

                                    <td>
                                        ${{ number_format(($product->product_price ?? 0) * $item->quantity, 2) }}
                                    </td>

                                    <td>
                                        @if($isPrescription && $prescription)

                                            <button
                                                class="viewPrescriptionBtn bg-blue-600 text-white px-3 py-1 rounded"
                                                data-eyes='@json($prescription->eyes ?? [])'
                                                data-product='@json($product)'
                                                data-quantity="{{ $item->quantity }}"
                                                data-price="{{ $product->product_price ?? 0 }}"
                                                data-pd="{{ $prescription->pd ?? '-' }}"
                                            >
                                                View
                                            </button>

                                        @else
                                            <span>No</span>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @empty
            <p class="text-center">No orders found</p>
        @endforelse
    </div>
</div>

<!-- MODAL -->
<div id="prescriptionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded w-full max-w-xl">

        <button id="closeModal" class="float-right">X</button>

        <h2 id="modalProductName" class="text-xl font-bold mb-2"></h2>
        <p id="modalQtyPrice"></p>
        <p id="modalPD"></p>

        <div id="prescriptionContent" class="mt-4"></div>
    </div>
</div>

<script>
$(document).ready(function() {

    $('.viewPrescriptionBtn').click(function() {

        let eyes = $(this).data('eyes') || [];
        let product = $(this).data('product') || {};
        let quantity = $(this).data('quantity');
        let price = $(this).data('price');
        let pd = $(this).data('pd');

        let content = '';

        if (eyes.length > 0) {
            eyes.forEach(function(eye) {
                content += `
                    <div>
                        <strong>${eye.eye ?? ''}</strong><br>
                        SPH: ${eye.sphere ?? '-'} |
                        CYL: ${eye.cylinder ?? '-'} |
                        AXIS: ${eye.axis ?? '-'}
                    </div><hr>
                `;
            });
        } else {
            content = 'No data';
        }

        $('#modalProductName').text(product.product_name || 'Product');
        $('#modalQtyPrice').text(`Qty: ${quantity} | Price: ${price}`);
        $('#modalPD').text(`PD: ${pd}`);
        $('#prescriptionContent').html(content);

        $('#prescriptionModal').removeClass('hidden').addClass('flex');
    });

    $('#closeModal').click(function() {
        $('#prescriptionModal').addClass('hidden').removeClass('flex');
    });

});
</script>

@endsection

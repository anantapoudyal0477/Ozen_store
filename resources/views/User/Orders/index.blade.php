@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Your Orders')

@section('content')

<style>
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .order-card {
        animation: slideInUp 0.4s ease-out forwards;
        opacity: 0;
    }

    .order-card:nth-child(1) { animation-delay: 0.1s; }
    .order-card:nth-child(2) { animation-delay: 0.2s; }
    .order-card:nth-child(3) { animation-delay: 0.3s; }

    .status-badge {
        display: inline-block;
        padding: 0.375rem 0.875rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending { background: #FEF3C7; color: #92400E; }
    .status-processing { background: #DBEAFE; color: #1E40AF; }
    .status-shipped { background: #E0E7FF; color: #4338CA; }
    .status-delivered { background: #D1FAE5; color: #065F46; }
    .status-cancelled { background: #FEE2E2; color: #991B1B; }

    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
    }

    .product-image-wrapper img {
        transition: transform 0.3s ease;
    }

    .product-image-wrapper:hover img {
        transform: scale(1.1);
    }

    .prescription-btn {
        transition: all 0.3s ease;
    }

    .prescription-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .modal-backdrop {
        backdrop-filter: blur(4px);
        transition: opacity 0.3s ease;
    }

    .modal-content {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-12 text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-3 tracking-tight">
                Your Orders
            </h1>
            <p class="text-gray-600 text-lg">Track and manage all your purchases</p>
            <div class="mt-4 h-1 w-24 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto rounded-full"></div>
        </div>

        @forelse($ListOfOrder as $order)
            <div class="order-card mb-8 bg-white rounded-2xl shadow-lg overflow-hidden hover-lift border border-gray-100">
                <!-- Order Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5 text-white">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                                <p class="text-xs font-medium opacity-90">Order Number</p>
                                <p class="text-lg font-bold">#{{ $order->order_number }}</p>
                            </div>
                            <span class="status-badge status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm opacity-90">Total Amount</p>
                            <p class="text-2xl font-bold">${{ number_format($order->total_price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Bar -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-3 border-b border-gray-200">
                    <div class="flex items-center gap-6 text-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span class="font-semibold text-gray-700">{{ $order->quantity }} Items</span>
                        </div>
                        <div class="h-4 w-px bg-gray-300"></div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-600">{{ $order->created_at->format('M d, Y') ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-200">
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700 text-sm">#</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700 text-sm">Product</th>
                                    <th class="text-center py-4 px-4 font-semibold text-gray-700 text-sm">Quantity</th>
                                    <th class="text-right py-4 px-4 font-semibold text-gray-700 text-sm">Price Details</th>
                                    <th class="text-center py-4 px-4 font-semibold text-gray-700 text-sm">Prescription</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($order->orderItems ?? [] as $idx => $item)
                                    @php
                                        $product = $item->product ?? null;
                                        $prescription = $order->prescriptions->firstWhere('product_id', $item->product_id);
                                    @endphp
                                    <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-700 rounded-full font-semibold text-sm">
                                                {{ $idx + 1 }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            @if($product)
                                                <div class="flex items-center gap-4">
                                                    <div class="product-image-wrapper w-16 h-16 flex-shrink-0">
                                                        <img src="{{ asset($product->product_image ?? 'placeholder.png') }}"
                                                             alt="{{ $product->product_name }}"
                                                             class="w-full h-full object-cover">
                                                    </div>
                                                    <span class="font-medium text-gray-900">{{ $product->product_name }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full font-medium">
                                                ×{{ $item->quantity }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <div class="space-y-1">
                                                <p class="text-gray-600 text-sm">Price: <span class="font-semibold">${{ number_format($product->product_price ?? 0, 2) }}</span></p>
                                                <p class="text-gray-600 text-sm">Tax: <span class="font-semibold">${{ number_format($product->tax ?? 0, 2) }}</span></p>
                                                <p class="text-gray-900 font-bold text-base border-t border-gray-200 pt-1">
                                                    ${{ number_format(($product->product_price ?? 0) * $item->quantity + ($product->tax ?? 0), 2) }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                           
                                            @if($item->isPrescription)
                                                <button class="viewPrescriptionBtn prescription-btn inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium text-sm shadow-md"
                                                        data-eyes='@json($prescription->eyes)'
                                                        data-product='@json($product)'
                                                        data-quantity='{{ $item->quantity }}'
                                                        data-price='{{ $product->product_price ?? 0 }}'
                                                        data-tax='{{ $product->tax ?? 0 }}'
                                                        data-total='{{ ($product->product_price ?? 0) * $item->quantity + ($product->tax ?? 0) }}'
                                                        data-pd='{{ $prescription->pd ?? "-" }}'>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    View Details
                                                </button>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium">
                                                    No Prescription
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No Orders Yet</h3>
                <p class="text-gray-500 mb-6">Start shopping to see your orders here</p>
                <a href="{{ route('User.Products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @endforelse
    </div>
</div>

<!-- Prescription Modal -->
<!-- Prescription Modal -->
<div id="prescriptionModal" class="modal-backdrop fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="modal-content glass-effect rounded-2xl w-full max-w-3xl p-8 relative shadow-2xl transform scale-95">
        <!-- Close Button -->
        <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Modal Header -->
        <div class="text-center mb-6">
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1" id="modalProductName"></h2>
            <p id="modalQtyPrice" class="text-gray-600 text-sm"></p>
        </div>

        <!-- PD Section -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-lg p-4 mb-6">
            <p id="modalPD" class="text-gray-800 font-semibold"></p>
        </div>

        <!-- Prescription Details -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 space-y-4">
            <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Prescription Details
            </h3>
            <div id="prescriptionContent" class="space-y-3 text-gray-700"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.viewPrescriptionBtn').click(function() {
        var eyes = $(this).data('eyes');
        var product = $(this).data('product');
        var quantity = $(this).data('quantity');
        var price = $(this).data('price');
        var tax = $(this).data('tax');
        var total = $(this).data('total');
        var pd = $(this).data('pd');

        // Prescription eyes content
        var content = '';
        if (eyes && eyes.length > 0) {
            eyes.forEach(function(eye) {
                content += `
                    <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                        <p class="font-bold text-blue-600 mb-2">${eye.eye.toUpperCase()} Eye</p>
                        <div class="grid grid-cols-3 gap-2 text-sm">
                            <div><span class="text-gray-500">SPH:</span> <span class="font-semibold">${eye.sphere ?? '-'}</span></div>
                            <div><span class="text-gray-500">CYL:</span> <span class="font-semibold">${eye.cylinder ?? '-'}</span></div>
                            <div><span class="text-gray-500">AXIS:</span> <span class="font-semibold">${eye.axis ?? '-'}</span></div>
                        </div>
                    </div>
                `;
            });
        } else {
            content = '<p class="text-gray-500 text-center py-4">No eye data available</p>';
        }

        $('#modalProductName').text(product.product_name || 'Product');
        $('#modalQtyPrice').html(`<strong>Qty:</strong> ${quantity} | <strong>Price:</strong> ${price} | <strong>Tax:</strong> ${tax} | <strong>Total:</strong> ${total}`);
        $('#modalPD').html(`<strong>Pupillary Distance (PD):</strong> ${pd}`);
        $('#prescriptionContent').html(content);

        $('#prescriptionModal').removeClass('hidden').addClass('flex');
        setTimeout(() => {
            $('.modal-content').removeClass('scale-95').addClass('scale-100');
        }, 10);
    });

    // Close modal
    $('#closeModal').click(function() {
        $('.modal-content').removeClass('scale-100').addClass('scale-95');
        setTimeout(() => {
            $('#prescriptionModal').removeClass('flex').addClass('hidden');
        }, 300);
    });

    $('#prescriptionModal').click(function(e) {
        if (e.target === this) {
            $('.modal-content').removeClass('scale-100').addClass('scale-95');
            setTimeout(() => {
                $('#prescriptionModal').removeClass('flex').addClass('hidden');
            }, 300);
        }
    });
});

</script>
@endsection

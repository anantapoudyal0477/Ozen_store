@extends('administrator.admin-layout-page')
@section('title','Orders')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<style>
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes modalSlide {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    
    .order-card {
        animation: slideIn 0.4s ease-out;
        transition: all 0.3s ease;
    }
    
    .order-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }
    
    .modal-content {
        animation: modalSlide 0.3s ease-out;
    }
    
    .btn-action {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .btn-action::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .btn-action:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .status-badge {
        backdrop-filter: blur(8px);
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .product-item {
        transition: all 0.3s ease;
    }
    
    .product-item:hover {
        background: #f9fafb;
        transform: translateX(8px);
    }
</style>

<!-- Header with gradient -->
<div class="gradient-bg rounded-2xl p-8 mb-8 text-white shadow-2xl">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold mb-2">📦 Order Management</h1>
            <p class="text-white/80 text-lg">Manage and track all customer orders</p>
        </div>
        <div class="text-right">
            <p class="text-5xl font-bold">{{ count($ListOfOrders) }}</p>
            <p class="text-white/80">Total Orders</p>
        </div>
    </div>
</div>

<div class="space-y-6">

@foreach($ListOfOrders as $index => $order)
<div class="order-card bg-white rounded-2xl shadow-lg p-6 border-l-4 
    {{ $order->status == 'pending' ? 'border-yellow-500' : '' }}
    {{ $order->status == 'ready' ? 'border-green-500' : '' }}
    {{ $order->status == 'canceled' ? 'border-red-500' : '' }}"
    style="animation-delay: {{ $index * 0.1 }}s">

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-3">
                <span class="text-3xl">
                    {{ $order->status == 'pending' ? '⏳' : '' }}
                    {{ $order->status == 'ready' ? '✅' : '' }}
                    {{ $order->status == 'canceled' ? '❌' : '' }}
                </span>
                <div>
                    <p class="text-2xl font-bold text-gray-800">#{{ $order->order_number }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                            </svg>
                            {{ $order->orderDetail->full_name ?? 'N/A' }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <span class="status-badge text-sm px-4 py-2 rounded-full font-semibold
                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border border-yellow-300' : '' }}
                    {{ $order->status == 'ready' ? 'bg-green-100 text-green-800 border border-green-300' : '' }}
                    {{ $order->status == 'canceled' ? 'bg-red-100 text-red-800 border border-red-300' : '' }}">
                    {{ ucfirst($order->status) }}
                </span>
                
                <span class="bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 text-sm px-4 py-2 rounded-full font-bold border border-purple-200">
                    Rs. {{ number_format($order->total_price, 2) }}
                </span>
            </div>
        </div>

        <div class="flex gap-3">
            <!-- View Button -->
            <form class="viewOrderForm" action="{{ route('Administrator.Orders.show', ['id' => '__id__']) }}" data-id="{{ $order->id }}">
                @csrf
                <button type="submit" class="btn-action bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View
                </button>
            </form>

            <!-- Cancel Button -->
            @if($order->status != 'canceled')
            <form class="cancelOrderForm" action="{{ route('Administrator.Orders.updateStatus', ['id' => '__id__']) }}" data-id="{{ $order->id }}">
                @csrf
                <button type="submit" class="btn-action bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-xl hover:from-red-700 hover:to-red-800 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancel
                </button>
            </form>
            @endif
        </div>

    </div>
</div>
@endforeach

</div>

<!-- Enhanced Modal -->
<div id="orderModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex justify-center items-center z-50 p-4">
    <div class="modal-content bg-white w-full max-w-5xl rounded-3xl shadow-2xl overflow-hidden">
        <div class="gradient-bg text-white p-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Order Details
            </h2>
            <button id="closeModal" class="text-3xl text-white hover:bg-white/20 w-10 h-10 rounded-full transition">×</button>
        </div>
        <div id="modalBody" class="p-8 overflow-y-auto max-h-[70vh]">
            <div class="flex items-center justify-center py-12">
                <svg class="animate-spin h-12 w-12 text-purple-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    // View Order
    $('.viewOrderForm').on('submit', function(e){
        e.preventDefault();

        let id = $(this).data('id');
        let url = $(this).attr('action').replace('__id__', id);

        $('#orderModal').removeClass('hidden');
        $('#modalBody').html(`
            <div class="flex items-center justify-center py-12">
                <svg class="animate-spin h-12 w-12 text-purple-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        `);

        $.get(url, function(order){
            console.log('Order Data:', order);

            let html = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl border border-blue-200">
                        <p class="text-sm text-blue-600 font-semibold mb-2">ORDER NUMBER</p>
                        <p class="text-3xl font-bold text-blue-900">#${order.order_number}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl border border-purple-200">
                        <p class="text-sm text-purple-600 font-semibold mb-2">STATUS</p>
                        <p class="text-2xl font-bold text-purple-900 capitalize">${order.status}</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 mb-6 border border-gray-200">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-gray-800">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                        </svg>
                        Customer Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Name</p>
                            <p class="font-semibold text-gray-800">${order.order_detail.full_name}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-semibold text-gray-800">${order.order_detail.email}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Phone</p>
                            <p class="font-semibold text-gray-800">${order.order_detail.phone}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Payment Method</p>
                            <p class="font-semibold text-gray-800 capitalize">${order.order_detail.payment_method}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Address</p>
                            <p class="font-semibold text-gray-800">${order.order_detail.address}, ${order.order_detail.city}</p>
                        </div>
                    </div>
                </div>

                <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Products
                </h3>
                <div class="space-y-3">
            `;

            order.order_items.forEach(item => {
                html += `
                    <div class="product-item flex items-center gap-4 p-4 border-2 border-gray-200 rounded-xl bg-white">
                        <img src="${item.product.product_image}" class="w-20 h-20 object-cover rounded-lg shadow-md" />
                        <div class="flex-1">
                            <p class="font-bold text-lg text-gray-800">${item.product.product_name}</p>
                            <div class="flex gap-4 mt-2 text-sm">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-semibold">Qty: ${item.quantity}</span>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">Rs. ${parseFloat(item.product.product_price).toFixed(2)}</span>
                                ${item.isPrescription == 1 ? '<span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full font-semibold">🧿 Prescription</span>' : ''}
                            </div>
                        </div>
                    </div>
                `;
            });

            html += `</div>`;

            if(order.prescriptions.length){
                html += `
                    <h3 class="text-xl font-bold mt-6 mb-4 flex items-center gap-2 text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Prescription Details
                    </h3>
                `;
                order.prescriptions.forEach(p => {
                    html += `
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6 rounded-2xl border-2 border-indigo-200 mb-4">
                            <p class="text-sm text-indigo-600 font-semibold mb-3">PUPILLARY DISTANCE (PD)</p>
                            <p class="text-2xl font-bold text-indigo-900 mb-4">${p.pd} mm</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    `;
                    p.glasses.forEach(g => {
                        html += `
                            <div class="bg-white border-2 border-indigo-300 p-4 rounded-xl shadow-sm">
                                <p class="font-bold text-lg text-indigo-900 mb-3">${g.eye.toUpperCase()} Eye 👁️</p>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Sphere (SPH):</span>
                                        <span class="font-semibold">${g.sphere}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Cylinder (CYL):</span>
                                        <span class="font-semibold">${g.cylinder}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Axis:</span>
                                        <span class="font-semibold">${g.axis}°</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    html += `</div></div>`;
                });
            }

            $('#modalBody').html(html);
        }).fail(function(xhr){
            console.error('Error fetching order:', xhr.responseText);
            $('#modalBody').html('<div class="text-center py-12"><p class="text-red-500 text-xl font-semibold">⚠️ Failed to load order</p></div>');
        });
    });

    // Cancel Order
    $('.cancelOrderForm').on('submit', function(e){
        e.preventDefault();

        if(!confirm('⚠️ Are you sure you want to cancel this order?')) return;

        let id = $(this).data('id');
        let url = $(this).attr('action').replace('__id__', id);
        let form = $(this);

        $.post(url, {_token: '{{ csrf_token() }}', status: 'canceled'}, function(res){
            alert('✅ ' + res.message);
            location.reload();
        }).fail(function(xhr){
            alert('❌ Error: ' + xhr.responseJSON.message);
        });
    });

    // Close modal
    $('#closeModal').click(function(){
        $('#orderModal').addClass('hidden');
    });

    // Close modal on outside click
    $('#orderModal').click(function(e){
        if(e.target === this){
            $(this).addClass('hidden');
        }
    });
});
</script>

@endsection
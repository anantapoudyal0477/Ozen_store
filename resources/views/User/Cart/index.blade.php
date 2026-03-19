@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Your Shopping Cart')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
                <p class="text-gray-600">Review your items before checkout</p>
            </div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Cart Items</h2>

                <select id="cartFilter"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="all">All Items</option>
                    <option value="regular">Regular</option>
                    <option value="prescription">Prescription</option>
                </select>
                <form id="clearCartForm" action="{{ route('User.cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" id="clearCartBtn" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600
                   border border-red-200 rounded-lg hover:bg-red-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M4 7h16" />
                        </svg>
                        Delete All
                    </button>
                </form>

            </div>




            @if (!empty($cartData) && count($cartData) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Cart Items Section -->
                    <div class="lg:col-span-2 space-y-4">
                        @php $sum = 0; @endphp
                        @foreach ($cartData as $item)
                            @php
                                $itemTotal = $item['price'] * $item['qty'];
                                $sum += $itemTotal;
                            @endphp
                            <div id="cartRow_{{ $item['cart_id'] }}" data-product-id="{{ $item['id'] }}"
                                data-type="{{ $item['type'] ?? 'regular' }}"
                                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-100">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        @if(!empty($item['image']))
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                                class="w-32 h-32 object-cover rounded-lg border-2 border-gray-100">
                                        @else
                                            <div class="w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <span class="text-gray-400 text-sm">No Image</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-grow space-y-3">
                                        <div>

                                            <h3 class="text-lg font-semibold text-gray-900"> {{ $item['name'] }}</h3>
                                            @if(isset($item['type']) && $item['type'] == 'prescription')
                                                <button
                                                    class="mt-1 inline-flex items-center text-sm text-blue-600 hover:text-blue-700 showPrescription"
                                                    data-details='@json($item['prescription_details'])'>
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    View Prescription Details
                                                </button>
                                            @endif
                                        </div>

                                        <div class="flex flex-wrap items-center gap-6">
                                            <!-- Price -->
                                            <div>
                                                <p class="text-xs text-gray-500 uppercase tracking-wide">Price</p>
                                                <p class="text-lg font-semibold text-gray-900">
                                                    ${{ number_format($item['price'], 2) }}</p>
                                            </div>

                                            <!-- Quantity -->
                                            <div>
                                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Quantity</p>
                                                <input type="number" name="quantity" min="1" value="{{ $item['qty'] }}"
                                                    class="w-20 border-2 border-gray-200 rounded-lg p-2 text-center font-medium focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition quantityInput"
                                                    data-cart-id="{{ $item['cart_id'] }}">
                                            </div>

                                            <!-- Total -->
                                            <div>
                                                <p class="text-xs text-gray-500 uppercase tracking-wide">Total</p>
                                                <p class="text-lg font-bold text-gray-900" id="itemTotal_{{ $item['cart_id'] }}">
                                                    ${{ number_format($itemTotal, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Remove Button -->
                                    <div class="flex-shrink-0 md:self-start">
                                        <form class="deleteCartItemForm" action="{{ route('User.cart.destroy', $item['cart_id']) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                                title="Remove item">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary Section -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6 border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                            @php
                                $subtotal = $sum;
                                $tax = $subtotal * 0.13;
                                $total = $subtotal + $tax;
                            @endphp

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-semibold">$<span
                                            id="subtotal">{{ number_format($subtotal, 2) }}</span></span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Tax (13%)</span>
                                    <span class="font-semibold">$<span id="tax">{{ number_format($tax, 2) }}</span></span>
                                </div>
                                <div class="border-t pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-gray-900">Total</span>
                                        <span class="text-2xl font-bold text-gray-900">$<span
                                                id="total">{{ number_format($total, 2) }}</span></span>
                                    </div>
                                </div>
                            </div>

                            <button id="checkoutBtn"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Proceed to Checkout
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Checkout Modal --}}
                <div id="checkoutModal"
                    class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
                    <div
                        class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all">
                        <div
                            class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                            <h2 class="text-2xl font-bold text-gray-900">Order Confirmation</h2>
                            <button id="closeCheckoutModal"
                                class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="p-6 space-y-6">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="text-left py-3 px-2 text-sm font-semibold text-gray-700">Product</th>
                                            <th class="text-center py-3 px-2 text-sm font-semibold text-gray-700">Qty</th>
                                            <th class="text-right py-3 px-2 text-sm font-semibold text-gray-700">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="checkoutItems" class="divide-y divide-gray-200">
                                        {{-- Filled dynamically --}}
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-between items-center bg-blue-50 rounded-xl p-4">
                                <span class="text-lg font-semibold text-gray-900">Grand Total</span>
                                <span class="text-2xl font-bold text-blue-600">$<span id="checkoutTotal"></span></span>
                            </div>

                            <form id="checkoutForm" method="POST" action="{{ route('User.checkout.store') }}">
                                @csrf
                                <input type="hidden" name="cart_data" id="cartDataInput">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Confirm Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Prescription Modal -->
                <div id="prescriptionModal"
                    class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all">
                        <div
                            class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                            <h2 class="text-xl font-bold text-white">Prescription Details</h2>
                            <button id="closePrescriptionModal"
                                class="text-white hover:text-gray-200 p-1 rounded-lg hover:bg-white/10 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="p-6">
                            <div class="bg-gray-50 rounded-xl p-4 mb-4">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="text-left py-2 text-sm font-semibold text-gray-700">Eye</th>
                                            <th class="text-center py-2 text-sm font-semibold text-gray-700">Sphere</th>
                                            <th class="text-center py-2 text-sm font-semibold text-gray-700">Cylinder</th>
                                            <th class="text-center py-2 text-sm font-semibold text-gray-700">Axis</th>
                                        </tr>
                                    </thead>
                                    <tbody id="prescriptionContent" class="divide-y divide-gray-200">
                                        <!-- Filled dynamically -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3">
                                <p class="text-sm"><strong class="text-gray-700">Pupillary Distance (PD):</strong> <span
                                        id="prescriptionPD" class="text-gray-900 font-semibold"></span></p>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                    <p class="text-gray-600 mb-6">Add some items to get started!</p>
                    <a href="{{ route('User.products.index') }}"
                        class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {

            // DELETE ITEM (AJAX)
            $(".deleteCartItemForm").off("submit").on("submit", function (e) {
                e.preventDefault();
                let form = $(this);
                let row = form.closest("[id^='cartRow_']");

                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        if (response.success) {
                            row.fadeOut(300, function () { $(this).remove(); });

                            // Update totals with comma formatting
                            $("#subtotal").text(response.cartSummary.subtotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                            $("#tax").text(response.cartSummary.tax.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                            $("#total").text(response.cartSummary.total.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

                            alert("Item removed from cart!");
                        } else {
                            alert("Failed to remove item.");
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) window.location.href = "{{ route('Login.index') }}";
                        else alert("Something went wrong!");
                    }
                });
            });

            // DYNAMIC QUANTITY UPDATE
            $(".quantityInput").off("input").on("input", function () {
                let input = $(this);
                let cartId = input.data("cart-id");
                let qty = parseInt(input.val());
                if (isNaN(qty) || qty < 1) return;

                $.ajax({
                    url: "/User/cart/update/" + cartId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "PUT",
                        quantity: qty
                    },
                    success: function (response) {
                        if (response.success) {
                            // Update item total with comma
                            let itemTotal = parseFloat(response.price) * qty;
                            let escapedId = response.cart_id.replace(/\./g, "\\.");
                            $("#itemTotal_" + escapedId).text("$" + itemTotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

                            // Update totals with comma
                            $("#subtotal").text(response.cartSummary.subtotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                            $("#tax").text(response.cartSummary.tax.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                            $("#total").text(response.cartSummary.total.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) window.location.href = "{{ route('Login.index') }}";
                        else alert("Something went wrong!");
                    }
                });
            });

            // PRESCRIPTION MODAL
            $(".showPrescription").on("click", function () {
                let details = $(this).data("details");
                console.log(details);
                if (!Array.isArray(details)) {
                    alert("Invalid prescription data");
                    return;
                }

                let left = {}, right = {}, pd = '';
                details.forEach(d => {
                    if (d.left_sphere) left.sphere = d.left_sphere;
                    if (d.right_sphere) right.sphere = d.right_sphere;
                    if (d.left_cylinder) left.cylinder = d.left_cylinder;
                    if (d.right_cylinder) right.cylinder = d.right_cylinder;
                    if (d.left_axis) left.axis = d.left_axis;
                    if (d.right_axis) right.axis = d.right_axis;
                    if (d.pd) pd = d.pd;
                });

                let tbody = `
                    <tr>
                        <td class="py-2 text-left">Left Eye</td>
                        <td class="py-2 text-center font-medium">${left.sphere || '-'}</td>
                        <td class="py-2 text-center font-medium">${left.cylinder || '-'}</td>
                        <td class="py-2 text-center font-medium">${left.axis || '-'}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-left">Right Eye</td>
                        <td class="py-2 text-center font-medium">${right.sphere || '-'}</td>
                        <td class="py-2 text-center font-medium">${right.cylinder || '-'}</td>
                        <td class="py-2 text-center font-medium">${right.axis || '-'}</td>
                    </tr>
                `;
                $("#prescriptionContent").html(tbody);
                $("#prescriptionPD").text(pd || 'Not specified');
                $("#prescriptionModal").removeClass("hidden");
            });

            $("#closePrescriptionModal").on("click", function (e) {
                console.log("Closing modal");
                $("#prescriptionModal").addClass("hidden");
            });

            // Open Checkout Modal
            $("#checkoutBtn").on("click", function () {
                let cartItems = [];
                let total = 0;
                console.log("dd");

                $("[id^='cartRow_']").each(function () {
                    let row = $(this);
                    let cartId = row.attr("id").replace('cartRow_', '');
                    let productId = row.data("product-id");
                    let name = row.find("h3").text().trim();
                    let qty = parseInt(row.find(".quantityInput").val());
                    let itemTotal = parseFloat(row.find("[id^='itemTotal_']").text().replace('$', '').replace(/,/g, ''));
                    let type = row.find(".showPrescription").length ? 'prescription' : 'regular';
                    let prescription = null;

                    if (type === 'prescription') {
                        // jQuery .data() automatically parses JSON
                        prescription = row.find(".showPrescription").data("details");
                    }

                    cartItems.push({
                        cart_id: cartId,
                        product_id: productId,
                        name: name,
                        qty: qty,
                        total: itemTotal,
                        type: type,
                        prescription_details: prescription
                    });

                    total += itemTotal;
                });

                // Fill modal table
                let tbody = "";
                cartItems.forEach(item => {
                    tbody += `<tr>
                                <td class="py-3 px-2 text-sm">${item.name} (${item.type})</td>
                                <td class="py-3 px-2 text-center text-sm font-medium">${item.qty}</td>
                                <td class="py-3 px-2 text-right text-sm font-semibold">$${item.total.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            </tr>`;
                });

                $("#checkoutItems").html(tbody);
                $("#checkoutTotal").text(total.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

                // Save cart data for form submission
                $("#cartDataInput").val(JSON.stringify(cartItems));

                $("#checkoutModal").removeClass("hidden");
            });

            // Close Checkout Modal
            $("#closeCheckoutModal, #checkoutModal").on("click", function (e) {
                if (e.target.id === "closeCheckoutModal" || e.target.id === "checkoutModal") {
                    $("#checkoutModal").addClass("hidden");
                }
            });

            // Submit Checkout Form
            $("#checkoutForm").on("submit", function (e) {
                console.log("cc");
                e.preventDefault();
                let cartItems = $("#cartDataInput").val();
                console.table( cartItems);

                $.post("{{ route('User.checkout.store') }}", {
                    _token: "{{ csrf_token() }}",
                    cart_items: cartItems
                }, function (response) {
                    if (response.success) {
                        alert(response.message);

                        // Empty cart UI
                        $("[id^='cartRow_']").remove();
                        $("#subtotal").text("0.00");
                        $("#tax").text("0.00");
                        $("#total").text("0.00");
                        $("#checkoutItems").html("");
                        $("#checkoutTotal").text("0.00");

                        // Hide checkout modal
                        $("#checkoutModal").addClass("hidden");
                        console.log(response);

                        // Optional: redirect after a short delay
                        setTimeout(function () {
                            window.location.href = response.redirect_url;
                        }, 500);
                    } else {
                        alert("Failed to place order.");
                    }
                }).fail(function (xhr) {
                    alert("Something went wrong!");
                });
            });



            $("#closeCheckoutModal, #checkoutModal").on("click", function (e) {
                if (e.target.id === "closeCheckoutModal" || e.target.id === "checkoutModal") {
                    $("#checkoutModal").addClass("hidden");
                }
            });

        });
        // CART FILTER
        $("#cartFilter").on("change", function () {
            let filter = $(this).val();
            let subtotal = 0;

            $("[id^='cartRow_']").each(function () {
                let row = $(this);
                let type = row.data("type");
                if (filter === "all" || filter === type) {
                    console.log("filter = " + filter, "type = " + type)
                    row.show();

                    // recalculate subtotal
                    let itemTotalText = row.find("[id^='itemTotal_']").text()
                        .replace('$', '')
                        .replace(/,/g, '');
                    subtotal += parseFloat(itemTotalText) || 0;
                } else {
                    row.hide();
                }
            });

            // recalc tax & total
            let tax = subtotal * 0.13;
            let total = subtotal + tax;

            $("#subtotal").text(subtotal.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $("#tax").text(tax.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $("#total").text(total.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
        });
        $("#clearCartForm").on("submit", function (e) {
            e.preventDefault();

            if (!confirm("Are you sure you want to remove all items from the cart?")) {
                return;
            }

            let form = $(this);

            $.ajax({
                url: form.attr("action"),
                type: "POST",
                data: form.serialize(),
                success: function (response) {
                    if (response.success) {

                        // Remove all cart rows
                        $("[id^='cartRow_']").fadeOut(300, function () {
                            $(this).remove();
                        });

                        // Reset totals
                        $("#subtotal").text("0.00");
                        $("#tax").text("0.00");
                        $("#total").text("0.00");

                        // Clear checkout modal data
                        $("#checkoutItems").html("");
                        $("#checkoutTotal").text("0.00");

                        alert(response.message);
                    }
                },
                error: function () {
                    alert("Failed to clear cart.");
                }
            });
        });

    </script>
@endsection

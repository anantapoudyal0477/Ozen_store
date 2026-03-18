@extends('user.user-layout-page')

@section('title', 'Confirm & Pay Order')

@section('content')

<h4>Order Items</h4>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Unit Price (Rs)</th>
            <th>Prescription</th>
            <th>Price (Rs)</th>
            <th>Tax 13% (Rs)</th>
            <th>Total (Rs)</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grandTotal = 0;
            $totalTax = 0;
            $actualPriceSum = 0;
        @endphp

        @foreach($order_items as $item)
            @php
                $actualPrice = $item->product->product_price * $item->quantity;
                $taxAmount = ($actualPrice * 13)/100;
                $total = $actualPrice + $taxAmount;

                $grandTotal += $total;
                $totalTax += $taxAmount;
                $actualPriceSum += $actualPrice;

                $prescription = $item->order->prescriptions->where('product_id', $item->product_id)->first();
            @endphp

            <tr>
                <td>{{ $item->product->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->product->product_price, 2) }}</td>
                <td>
                    @if($item->isPrescription)
                        <strong>Yes</strong>
                        <ul style="margin:0; padding-left:15px;">
                            @if($prescription)
                                <li><strong>PD:</strong> {{ $prescription->pd }}</li>
                                @foreach($prescription->glasses as $glass)
                                    <li>
                                        <strong>{{ ucfirst($glass->eye) }} Eye</strong> —
                                        Sphere: {{ $glass->sphere }},
                                        Cylinder: {{ $glass->cylinder }},
                                        Axis: {{ $glass->axis }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @else
                        No
                    @endif
                </td>
                <td>{{ number_format($actualPrice, 2) }}</td>
                <td>{{ number_format($taxAmount, 2) }}</td>
                <td>{{ number_format($total, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align:right;"><strong>Totals:</strong></td>
            <td><strong>Rs {{ number_format($actualPriceSum, 2) }}</strong></td>
            <td><strong>Rs {{ number_format($totalTax, 2) }}</strong></td>
            <td><strong>Rs {{ number_format($grandTotal, 2) }}</strong></td>
        </tr>
    </tfoot>
</table>


<hr>
<p style="color:red; font-weight:bold;">
    ⚠️ Please confirm your order by pressing "Confirm Order". If you leave this page without confirming or an interrupt occurs, your order will be canceled and removed.
</p>

<div style="margin-top:20px;">
    <button id="confirmOrderBtn" style="background:green; color:white; padding:10px 15px;">Confirm Order & Pay</button>
    <button id="cancelOrderBtn" style="background:red;color:white; padding:10px 15px;">Cancel Order</button>
    <button id="generateQRBtn" style="background:blue;color:white; padding:10px 15px;">Generate QR for Payment</button>
</div>

<div id="qrContainer" style="margin-top:20px;"></div>

<!-- QRious for QR generation -->
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>

{{-- <script>
    const orderNumber = "{{ $order_number }}";
    const paymentData = @json($paymentPayload);

    console.log("Payment Payload:", paymentData);

    // 1️⃣ Confirm Order / Pay button
    function payNow() {
        fetch('https://payment-gateway.example.com/initiate', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(paymentData)
        })
        .then(res => res.json())
        .then(data => {
            console.log("Gateway Response:", data);
            if(data.payment_url) window.location.href = data.payment_url;
        })
        .catch(err => alert("Payment failed: " + err));
    }
    document.getElementById('confirmOrderBtn').addEventListener('click', payNow);

    // 2️⃣ Helper: build cancel order URL dynamically
    function getCancelUrl() {
        return "{{ route('User.orders.destroy', ':order') }}".replace(':order', orderNumber);
    }

    // 3️⃣ Cancel order via AJAX
    async function cancelOrder() {
        if(!confirm('Are you sure you want to cancel this order?')) return;

        try {
            const res = await fetch(getCancelUrl(), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();
            if(data.success){
                alert(data.message);
                window.location.href = "{{ route('User.orders.index') }}";
            } else {
                alert('Failed to cancel order: '+data.message);
            }
        } catch(err){
            alert('Error: '+err.message);
        }
    }
    document.getElementById('cancelOrderBtn').addEventListener('click', cancelOrder);

    // 4️⃣ Warn user if leaving page without confirming + auto-cancel via Beacon
    window.addEventListener('beforeunload', function (e) {
        navigator.sendBeacon(getCancelUrl(), null);
        e.preventDefault();
        e.returnValue = '⚠️ If you leave without confirming, your order will be canceled!';
    });

    // 5️⃣ QR Code Generation for direct payment
    document.getElementById('generateQRBtn').addEventListener('click', () => {
        const paymentUrl = "https://payment-gateway.example.com/initiate?order=" + orderNumber;

        const qr = new QRious({
            element: document.createElement('canvas'),
            value: paymentUrl,
            size: 200
        });

        const container = document.getElementById('qrContainer');
        container.innerHTML = '';
        container.appendChild(qr.element);

        const link = document.createElement('a');
        link.href = paymentUrl;
        link.target = "_blank";
        link.textContent = "Click here to pay if QR scan fails";
        link.style.display = 'block';
        link.style.marginTop = '10px';
        container.appendChild(link);
    });
</script> --}}
<script>
    const orderNumber = "{{ $order_number }}";
    const paymentData = @json($paymentPayload);

    // 1️⃣ Confirm Order / Pay button
    document.getElementById('confirmOrderBtn').addEventListener('click', () => {
        console.log("Order confirmed. Payment Payload:", paymentData);
        alert("Order confirmed! Check console for payment payload.");
    });

    // 2️⃣ Helper: build cancel order URL dynamically
    function getCancelUrl() {
        return "{{ route('User.orders.destroy', ':order') }}".replace(':order', orderNumber);
    }

    // 3️⃣ Cancel order via AJAX
    async function cancelOrder() {
        if(!confirm('Are you sure you want to cancel this order?')) return;

        try {
            const res = await fetch(getCancelUrl(), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();
            if(data.success){
                alert(data.message);
                window.location.href = "{{ route('User.orders.index') }}";
            } else {
                alert('Failed to cancel order: '+data.message);
            }
        } catch(err){
            alert('Error: '+err.message);
        }
    }
    document.getElementById('cancelOrderBtn').addEventListener('click', cancelOrder);

    // 4️⃣ Warn user if leaving page without confirming + auto-cancel via Beacon
    window.addEventListener('beforeunload', function (e) {
        navigator.sendBeacon(getCancelUrl(), null);
        e.preventDefault();
        e.returnValue = '⚠️ If you leave without confirming, your order will be canceled!';
    });

    // 5️⃣ QR Code Generation for direct payment (shows JSON payload)
  document.getElementById('generateQRBtn').addEventListener('click', () => {
    const jsonUrl = "{{ route('User.payment.json', ':order') }}".replace(':order', orderNumber);

    const qr = new QRious({
        element: document.createElement('canvas'),
        value: jsonUrl,
        size: 200
    });

    const container = document.getElementById('qrContainer');
    container.innerHTML = '';
    container.appendChild(qr.element);

    const link = document.createElement('a');
    link.href = jsonUrl;
    link.target = "_blank";
    link.textContent = "Click here to view order JSON";
    link.style.display = 'block';
    link.style.marginTop = '10px';
    container.appendChild(link);

    console.log("QR generated! Open the link to view order JSON.");
});

</script>

@endsection

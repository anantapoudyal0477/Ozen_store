<table class="min-w-full bg-white border rounded-lg">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border">Order #</th>
            <th class="px-4 py-2 border">Customer</th>
            <th class="px-4 py-2 border">Products</th>
            <th class="px-4 py-2 border">Total Price</th>
            <th class="px-4 py-2 border">Status</th>
            <th class="px-4 py-2 border">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr>
            <td class="px-4 py-2 border">{{ $order->order_number }}</td>
            <td class="px-4 py-2 border">{{ $order->orderDetail->full_name ?? 'N/A' }}</td>
            <td class="px-4 py-2 border">
                <ul class="list-disc pl-5">
                    @foreach($order->orderItems as $item)
                        <li>{{ $item->product->product_name ?? 'N/A' }} (x{{ $item->quantity }})</li>
                    @endforeach
                </ul>
            </td>
            <td class="px-4 py-2 border">Rs. {{ number_format($order->total_price, 2) }}</td>
            <td class="px-4 py-2 border">{{ ucfirst($order->status) }}</td>
            <td class="px-4 py-2 border">{{ $order->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="px-4 py-2 text-center text-gray-500">No orders found</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {!! $orders->links() !!}
</div>

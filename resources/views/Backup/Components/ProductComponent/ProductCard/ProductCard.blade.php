   <!-- Products Section -->
<div id="products" class="container mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold mb-6 text-center">Featured Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach ($productData as $data)
        <form action="{{ route('Cart.add',$data->id) }}" method="POST" class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            @csrf
            <img src="{{ asset($data->product_image) }}" alt="{{ $data->product_name }}"
                 class="mb-4 w-full h-48 object-cover rounded">
            <h3 class="text-lg font-semibold mb-2">
    <a href="{{ route('Products.show', $data->id) }}" class="text-blue-600 hover:underline">
        {{ $data->product_name }}
    </a>
</h3>

            <p class="text-gray-600 mb-2">{{ $data->product_description }}</p>
            <p class="text-gray-800 font-bold mb-4">${{ number_format($data->product_price, 2) }}</p>

            <input type="hidden" name="id" value="{{ $data->id }}">
            <input type="hidden" name="product_name" value="{{ $data->product_name }}">
            <input type="hidden" name="product_price" value="{{ $data->product_price }}">

            @if($data->product_stock > 0)
                <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-600 transition">
                    Add to Cart
                </button>
            @else
                <span class="text-red-500 font-semibold">Out of Stock</span>
            @endif
        </form>
        @endforeach

    </div>
</div>

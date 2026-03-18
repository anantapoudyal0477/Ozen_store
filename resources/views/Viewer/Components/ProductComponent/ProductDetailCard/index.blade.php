<!-- Product Section -->
<section class="bg-gradient-to-r from-blue-50 to-gray-100 py-12 flex justify-center">
    <div class="bg-white rounded-3xl shadow-2xl max-w-5xl w-full p-8 flex flex-col md:flex-row items-center md:items-start gap-8 transition hover:shadow-3xl">

        <!-- Product Image -->
        <div class="w-full md:w-1/2">
            <img src="{{ asset($productData->product_image) }}" alt="{{ $productData->product_name }}"
                 class="rounded-2xl object-cover w-full h-full shadow-lg hover:scale-105 transition-transform duration-300">
        </div>

        <!-- Product Details Form -->
        <div class="w-full md:w-1/2 flex flex-col gap-4">
            <form action="{{ route('Cart.add', $productData->id) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $productData->id }}">

                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">{{ $productData->product_name }}</h1>
                <p class="text-gray-600 text-lg md:text-xl">{{ $productData->product_description }}</p>

                <div class="mt-4 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                    <span class="text-3xl font-semibold text-gray-900">${{ number_format($productData->product_price, 2) }}</span>
                    @if($productData->product_stock > 0)
                        <span class="px-4 py-1 bg-green-100 text-green-800 font-medium rounded-full">In Stock</span>
                    @else
                        <span class="px-4 py-1 bg-red-100 text-red-800 font-medium rounded-full">Out of Stock</span>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-col sm:flex-row gap-4">
                    @if($productData->product_stock > 0)
                        <button type="submit"
                                class="bg-orange-600 text-white py-3 px-8 rounded-xl font-medium hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                            Add to Cart
                        </button>
                    @endif

                    <a href="{{ route('Products.index') }}"
                       class="border border-gray-300 text-gray-700 py-3 px-8 rounded-xl font-medium hover:bg-gray-100 transition shadow-sm hover:shadow-md text-center">
                        Back to Products
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Products Section -->
<div id="products" class="container mx-auto py-12 px-6">
    <h2 class="text-4xl font-bold text-center mb-10 text-gray-800 tracking-tight">
        Featured Products
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($productData as $data)
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-lg
                        transition duration-300 flex flex-col relative group">

                <!-- Stock Badge -->
                <div class="absolute top-3 right-3">
                    @if($data->product_stock > 0)
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                            In Stock
                        </span>
                    @else
                        <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">
                            Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Product Image -->
                <a href="{{ route('Products.show', $data->id) }}">
                    <div class="overflow-hidden rounded-lg mb-4 h-56 w-full">
                        <img src="{{ asset($data->product_image) }}"
                             alt="{{ $data->product_name }}"
                             class="w-full h-full object-cover transform group-hover:scale-105
                                    transition duration-500 rounded-lg">
                    </div>
                </a>

                <!-- Product Name -->
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-1">
                    <a href="{{ route('Products.show', $data->id) }}"
                       class="hover:text-blue-600 transition duration-200">
                        {{ $data->product_name }}
                    </a>
                </h3>

                <!-- Product Description -->
                <p class="text-gray-500 text-sm text-center mb-3 line-clamp-2">
                    {{ $data->product_description }}
                </p>

                <!-- Price -->
                <p class="text-xl font-bold text-gray-900 text-center mb-4">
                    ${{ number_format($data->product_price, 2) }}
                </p>

                <!-- Cart Action -->
                <div class="mt-auto w-full">
                    @if($data->product_stock > 0)
                        @auth
                            <!-- Logged In View -->
                            <form action="{{ route('Cart.add', $data->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="product_name" value="{{ $data->product_name }}">
                                <input type="hidden" name="product_price" value="{{ $data->product_price }}">

                                <input type="number" name="product_quantity" min="1"
                                       placeholder="Quantity"
                                       class="border border-gray-300 rounded-lg p-2 w-full mb-3
                                              focus:outline-none focus:ring focus:ring-blue-300">

                                <button type="submit"
                                        class="bg-blue-600 text-white py-2 px-4 rounded-lg w-full
                                               hover:bg-blue-700 transition shadow">
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <!-- Guest View -->
                            <div class="text-center">
                                <a href="{{ route('Login.index') }}"
                                   class="text-gray-800 py-2 px-4 rounded-lg w-full inline-block
                                          border border-gray-800 hover:bg-gray-900 hover:text-white transition">
                                    Login to Buy
                                </a>
                            </div>
                        @endauth
                    @else
                        <span class="text-red-600 font-semibold text-center block py-2">
                            Out of Stock
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $productData->links('vendor.pagination.tailwind') }}
    </div>
</div>

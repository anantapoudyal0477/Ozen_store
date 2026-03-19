@extends('Administrator.admin-layout-page')
@section('title',$pageTitle??"exe")
@section('content')
{{-- {{print_r($productData)}} --}}
<!-- Edit Product Section -->
<section class="bg-gray-50 py-12 flex justify-center">
    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full p-8 transition hover:shadow-3xl">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Edit Product</h1>

        <form action="{{ route('Administrator.Products.update', $productData->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Product Name</label>
                <input type="text" name="product_name" value="{{ $productData->product_name }}"
                       class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Product Description -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="product_description" rows="4"
                          class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $productData->product_description }}</textarea>
            </div>

            <!-- Product Price -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Price ($)</label>
                <input type="number" name="product_price" step="0.01" value="{{ $productData->product_price }}"
                       class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Product Image -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Product Image</label>
                <input type="file" name="product_image"
                       class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if($productData->product_image)
                    <img src="{{ asset($productData->product_image) }}" alt="Current Image"
                         class="mt-2 w-32 h-32 object-cover rounded-xl shadow-md">
                @endif
            </div>

            <!-- Product Stock -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Stock Quantity</label>
                <input type="number" name="product_stock" value="{{ $productData->product_stock }}"
                       class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-4 justify-end">
                <a href="{{ route('Administrator.Products.index') }}"
                   class="inline-block border border-gray-300 text-gray-700 py-3 px-6 rounded-xl font-medium hover:bg-gray-100 transition text-center">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white py-3 px-6 rounded-xl font-medium hover:bg-blue-700 transition shadow-md">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</section>

@endsection

@extends('Administrator.admin-layout-page')
@section('title',$pageTitle??"exe")
@section('content')
{{-- @include('administrator.components.messages.error_messages') --}}
{{-- @include('administrator.components.messages.success_messages') --}}

<div class="flex justify-end mb-6">
    <button
        type="button"
        id="openAddProductModal"
        class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300">
        + Add New Product
    </button>
</div>
<div id="addProductModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full p-8 relative transform scale-95 opacity-0 transition-all duration-300">

        <!-- Close Button -->
        <button id="closeAddProductModal" class="absolute top-6 right-6 w-10 h-10 bg-gray-100 hover:bg-red-100 rounded-full flex items-center justify-center text-gray-600 hover:text-red-600 transition-all duration-300">
            &times;
        </button>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Add Product</h1>

        <form id="addProductForm" action="{{ route('Administrator.Products.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf

            <!-- Product Name -->
            <input type="text" name="product_name" placeholder="Product Name" class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

            <!-- Product Description -->
            <textarea name="product_description" rows="4" placeholder="Description" class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>

            <!-- Product Price -->
            <input type="number" name="product_price" step="0.01" placeholder="Price" class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

            <!-- Product Stock -->
            <input type="number" name="product_stock" placeholder="Stock Quantity" class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

            <!-- Product Image -->
            <input type="file" name="product_image" accept="image/*" class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-4 justify-end">
                <button type="button" id="cancelAddProduct" class="inline-block border border-gray-300 text-gray-700 py-3 px-6 rounded-xl font-medium hover:bg-gray-100 transition">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-xl font-medium hover:bg-blue-700 transition shadow-md">Add Product</button>
            </div>
        </form>
    </div>
</div>

<div >

    @include('administrator.components.productComponent.productCard.index',["productData"=>$products])
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {

    // Open modal
    $("#openAddProductModal").click(function() {
        $("#addProductModal").removeClass("hidden").find('div:first').addClass('scale-100 opacity-100');
    });

    // Close modal
    $("#closeAddProductModal, #cancelAddProduct").click(function() {
        $("#addProductModal").addClass("hidden").find('div:first').removeClass('scale-100 opacity-100');
        $("#addProductForm")[0].reset();
    });

    // Click outside modal content to close
    $("#addProductModal").click(function(e) {
        if (e.target === this) {
            $(this).addClass("hidden").find('div:first').removeClass('scale-100 opacity-100');
            $("#addProductForm")[0].reset();
        }
    });

    // AJAX form submission
    $("#addProductForm").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert("Product added successfully!");
                $("#addProductModal").addClass("hidden").find('div:first').removeClass('scale-100 opacity-100');
                $("#addProductForm")[0].reset();
                // Optional: reload the product list
                location.reload();
            },
            error: function(xhr) {
                alert("Error adding product. Please check the inputs.");
                console.error(xhr.responseText);
            }
        });
    });

});
</script>

@endsection

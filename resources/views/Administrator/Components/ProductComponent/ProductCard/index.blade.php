<!-- Products Section -->
<div id="products" class="relative py-20 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 overflow-hidden">

    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

    <div class="container mx-auto relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-2xl mb-6 transform hover:rotate-6 transition-transform duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h2 class="text-5xl font-black mb-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Featured Products
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Discover our curated collection of premium eyewear designed for style and comfort
            </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            @foreach ($productData as $data)
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden transform hover:-translate-y-3 hover:shadow-2xl transition-all duration-500">

                    <!-- Gradient Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/0 to-purple-500/0 group-hover:from-blue-500/10 group-hover:to-purple-500/10 transition-all duration-500 z-10 pointer-events-none"></div>

                    <!-- Stock Badge -->
                    <div class="absolute top-4 right-4 z-20">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                            {{ $data->product_stock }} in stock
                        </div>
                    </div>

                    <!-- Product Image Container -->
                    <div class="relative w-full h-72 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-50">
                        <img src="{{ asset($data->product_image) }}"
                             alt="{{ $data->product_name }}"
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                        <!-- Image Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>

                    <!-- Product Info -->
                    <div class="relative p-6 space-y-4">

                        <!-- Product Name -->
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                            {{ $data->product_name }}
                        </h3>

                        <!-- Product Description -->
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 min-h-[2.5rem]">
                            {{ $data->product_description }}
                        </p>

                        <!-- Price Tag -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Price</p>
                                <p class="text-3xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                    ${{ number_format($data->product_price, 2) }}
                                </p>
                            </div>

                            <!-- Admin Controls -->
                            <div class="flex items-center space-x-3">
                                <!-- Edit Button -->
                                <button class="editBtn group/btn relative w-11 h-11 bg-gradient-to-br from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 flex items-center justify-center"
                                        data-id="{{ $data->id }}">
                                    <i class="fas fa-edit text-white text-lg"></i>
                                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-3 py-1 rounded-lg opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                                        Edit Product
                                    </div>
                                </button>

                                <!-- Delete Button -->
                                <form id="ProductDeleteForm" action="{{ route('Administrator.Products.destroy', $data->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="group/btn relative w-11 h-11 bg-gradient-to-br from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 flex items-center justify-center">
                                        <i class="fas fa-trash text-white text-lg"></i>
                                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-3 py-1 rounded-lg opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                                            Delete Product
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!-- Decorative Corner -->
                    <div class="absolute top-0 left-0 w-20 h-20 bg-gradient-to-br from-blue-500/10 to-transparent rounded-br-full"></div>
                    <div class="absolute bottom-0 right-0 w-20 h-20 bg-gradient-to-tl from-purple-500/10 to-transparent rounded-tl-full"></div>
                </div>

                <!-- Edit Modal -->
                <div id="modal-{{ $data->id }}" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden p-4 overflow-y-auto">
                    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full p-8 my-8 relative transform scale-95 opacity-0 transition-all duration-300"
                         style="animation: modalFadeIn 0.3s ease-out forwards;">

                        <!-- Close Button -->
                        <button class="closeBtn absolute top-6 right-6 w-10 h-10 bg-gray-100 hover:bg-red-100 rounded-full flex items-center justify-center text-gray-600 hover:text-red-600 transition-all duration-300 group">
                            <span class="text-2xl group-hover:rotate-90 transition-transform duration-300">&times;</span>
                        </button>

                        <!-- Modal Header -->
                        <div class="text-center mb-8">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-xl mb-4">
                                <i class="fas fa-edit text-white text-2xl"></i>
                            </div>
                            <h1 class="text-4xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Edit Product
                            </h1>
                            <p class="text-gray-600 mt-2">Update product information and details</p>
                        </div>

                        <form id="ProductForm" action="{{ route('Administrator.Products.update', $data->id) }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Two Column Grid for Form Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Product Name -->
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-bold mb-2 flex items-center">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                        Product Name
                                    </label>
                                    <input type="text"
                                           name="product_name"
                                           value="{{ $data->product_name }}"
                                           class="w-full border-2 border-gray-200 rounded-xl p-4 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 hover:bg-white"
                                           required>
                                </div>

                                <!-- Product Price -->
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2 flex items-center">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Price ($)
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-lg">$</span>
                                        <input type="number"
                                               name="product_price"
                                               step="0.01"
                                               value="{{ $data->product_price }}"
                                               class="w-full border-2 border-gray-200 rounded-xl p-4 pl-8 focus:outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-gray-50 hover:bg-white"
                                               required>
                                    </div>
                                </div>

                                <!-- Product Stock -->
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2 flex items-center">
                                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                                        Stock Quantity
                                    </label>
                                    <input type="number"
                                           name="product_stock"
                                           value="{{ $data->product_stock }}"
                                           class="w-full border-2 border-gray-200 rounded-xl p-4 focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-300 bg-gray-50 hover:bg-white"
                                           required>
                                </div>

                                <!-- Product Description -->
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-bold mb-2 flex items-center">
                                        <span class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></span>
                                        Description
                                    </label>
                                    <textarea name="product_description"
                                              rows="4"
                                              class="w-full border-2 border-gray-200 rounded-xl p-4 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 bg-gray-50 hover:bg-white resize-none"
                                              required>{{ $data->product_description }}</textarea>
                                </div>

                                <!-- Product Image -->
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-bold mb-2 flex items-center">
                                        <span class="w-2 h-2 bg-pink-500 rounded-full mr-2"></span>
                                        Product Image
                                    </label>
                                    <div class="flex items-start gap-6">
                                        <div class="flex-1">
                                            <input type="file"
                                                   name="product_image"
                                                   accept="image/*"
                                                   class="w-full border-2 border-gray-200 rounded-xl p-4 focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-100 transition-all duration-300 bg-gray-50 hover:bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-gradient-to-r file:from-pink-500 file:to-rose-500 file:text-white file:font-semibold hover:file:from-pink-600 hover:file:to-rose-600 file:cursor-pointer">
                                        </div>
                                        @if($data->product_image)
                                            <div class="flex-shrink-0">
                                                <div class="relative group">
                                                    <img src="{{ asset($data->product_image) }}"
                                                         alt="Current Image"
                                                         class="w-32 h-32 object-cover rounded-2xl shadow-lg border-4 border-white">
                                                    <div class="absolute inset-0 bg-black/50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                        <span class="text-white text-xs font-semibold">Current</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                                <button type="button"
                                        class="cancelBtn flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-4 px-6 rounded-xl font-bold transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-4 px-6 rounded-xl font-bold transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-0.5">
                                    <i class="fas fa-check mr-2"></i>
                                    Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            @endforeach

        </div>

        <!-- Empty State -->
        @if($productData->isEmpty())
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <i class="fas fa-box-open text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">No Products Available</h3>
                <p class="text-gray-600">Start by adding your first product to the collection</p>
            </div>
        @endif

    </div>
</div>

<style>
@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

@keyframes modalFadeIn {
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
$(document).ready(function() {
    // Open modal
    $(".editBtn").click(function() {
        let id = $(this).data("id");
        $("#modal-" + id).removeClass("hidden");
    });

    // Close modal
    $(".closeBtn, .cancelBtn").click(function() {
        $(this).closest('div[id^="modal-"]').addClass("hidden");
    });

    // Click outside modal content to close
    $('[id^="modal-"]').click(function(e) {
        if (e.target === this) {
            $(this).addClass("hidden");
        }
    });

    // Capture all edit forms submit
    $('[id^="modal-"] form').submit(function(e) {
        e.preventDefault(); // prevent actual form submission
        console.log("Submitting form for product ID:", $(this).attr("action").split('/').pop());
        console.log("URL");
        let url = $(this).attr("action");
        console.log($(this).attr("action"));
        let form = new FormData(this); // grab all form data
        $.ajax({
            url: url,
            type: "POST",
            data: form,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(url);
                alert("Product updated successfully!");
                location.reload(); // reload page to see changes
            },
            error: function(xhr) {
                alert("An error occurred while updating the product.");
            }
        });


        console.log("Form data for product ID:", $(this).attr("action").split('/').pop());

        // Optional: close modal after logging
        $(this).closest('div[id^="modal-"]').addClass("hidden");
    });


    $("#ProductDeleteForm").submit(function(e) {
        e.preventDefault(); // prevent actual form submission
        let url = $(this).attr("action");
        $.ajax({
            url: url,
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert("Product deleted successfully!");
                location.reload(); // reload page to see changes
            },
            error: function(xhr) {
                alert("An error occurred while deleting the product.");
            }
        });
    });
    // Add to wishlist
$(".wishlistForm").on("submit", function(e) {
    e.preventDefault();
    let form = $(this);

    $.post(form.attr("action"), form.serialize(), function () {
        alert("Product added to wishlist!");
    }).fail(function(xhr) {
        if(xhr.status === 401) window.location.href = "{{ route('Login.index') }}";
        else alert("Something went wrong!");
    });
});

});
</script>

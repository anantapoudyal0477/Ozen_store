<!-- Products Section -->
<div id="products" class="container mx-auto py-12 px-6">
    <h2 class="text-4xl font-bold text-center mb-10 text-gray-800">Products</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($productData as $data)
        <div class="border rounded-lg shadow-lg overflow-hidden flex flex-col bg-white">

            <!-- Product Image -->
            <img src="{{ asset($data->product_image) }}" alt="{{ $data->product_name }}" class="w-full h-48 object-cover">

            <div class="p-4 flex flex-col flex-1 justify-between">
                <!-- Product Name -->
                <h3 class="text-lg font-semibold text-gray-900">{{ $data->product_name }}</h3>

                <!-- Product Price -->
                <p class="text-gray-700 font-medium mt-1">Rs. {{ $data->product_price }}</p>

                <!-- Quantity Selector -->
                <div class="flex items-center mt-3 space-x-2">
                    <button type="button" class="qty-btn bg-gray-200 px-3 py-1 rounded" data-action="decrease">-</button>
                    <input type="text" value="1" class="qty-input w-12 text-center border rounded" readonly>
                    <button type="button" class="qty-btn bg-gray-200 px-3 py-1 rounded" data-action="increase">+</button>
                </div>

                <!-- Action -->
                <div class="mt-4">
                    @if ($key=="CartDisabled")
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="selected_products[]" value="{{ $data->id }}" class="w-5 h-5 border-gray-400 rounded cursor-pointer qty-checkbox" data-qty="1">
                        <span class="text-gray-700">Select Item</span>
                    </label>
                    @else
                    <form action="{{ route('User.cart.store', $data->id) }}" method="POST" class="cartForm">
                        @csrf
                        <input type="hidden" name="quantity" value="1" class="form-qty">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            Add to Cart
                        </button>
                    </form>
                      <!-- Add to Wishlist Form -->
        <form id="WishlistForm" action="{{ route('User.wishlist.store', $data->id) }}" method="POST" class="wishlistForm">
            @csrf
            <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">
                Add to Wishlist
            </button>
        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if ($key=="CartDisabled")
    <div class="mt-6 text-center">
        <button type="button" id="sendPrescription" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
            Send Prescription
        </button>
    </div>
    @endif
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>

<!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
$(document).ready(function () {
    // Quantity buttons
    $(".qty-btn").click(function () {
        let input = $(this).siblings(".qty-input");
        let val = parseInt(input.val());
        if ($(this).data("action") === "increase") input.val(val + 1);
        else if (val > 1) input.val(val - 1);

        // Update hidden input or checkbox data-qty
        let formQty = $(this).closest(".border").find(".form-qty");
        if(formQty.length) formQty.val(input.val());
        let checkbox = $(this).closest(".border").find(".qty-checkbox");
        if(checkbox.length) checkbox.data("qty", input.val());
    });

    // Add to cart
    $(".cartForm").on("submit", function (e) {
        e.preventDefault();
        let form = $(this);
        $.post(form.attr("action"), form.serialize(), function () {
            alert("Product added to cart!");
            UpdateCartCount();
        }).fail(function (xhr) {
            if(xhr.status === 401) window.location.href = "{{ route('Login.index') }}";
            else alert("Something went wrong!");
        });
    });
    // Add to wishlist
    $("#WishlistForm").on("submit", function (e) {
        e.preventDefault();
        let form = $(this);
        $.post(form.attr("action"), form.serialize(), function () {
            alert("Product added to wishlist!");
            UpdateWishlistCount();
        }).fail(function (xhr) {
            if(xhr.status === 401) window.location.href = "{{ route('Login.index') }}";
            else alert("Something went wrong!");
        });
    });

    // Send prescription
    $("#sendPrescription").click(function () {
        let selected = [];
        let eyeData = @json($EyePowerData);

        $("input[name='selected_products[]']:checked").each(function () {
            selected.push({ id: $(this).val(), qty: $(this).data("qty") || 1 });
        });

        if(selected.length === 0) return alert("Please select at least one product.");

        $.post("{{ route('User.cart.storeMultipleItems') }}", {
            _token: "{{ csrf_token() }}",
            selected_products: selected,
            EyeData: eyeData
        }, function () {
            alert("Prescription sent successfully!");
            window.location.href = "{{ route('User.cart.index') }}";
        }).fail(function (xhr) {
            console.log(xhr.responseText);
            alert("Something went wrong!");
        });
    });
});
</script>

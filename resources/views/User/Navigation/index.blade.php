<aside class="w-64 bg-white/95 dark:bg-gray-900 backdrop-blur-lg shadow-md flex-shrink-0 h-full flex flex-col">
    <!-- Logo -->
    <div class="flex items-center space-x-3 p-6 group">
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-xl blur-md opacity-0 group-hover:opacity-40 transition-opacity duration-300"></div>
            <img src="{{ asset($company_brand->company_brand_logo ?? 'default-logo.png') }}"
                 alt="{{ $company_brand->company_brand_name ?? 'Brand' }}"
                 class="relative h-12 w-12 object-contain rounded-xl ring-2 ring-gray-200 group-hover:ring-blue-300 transition-all duration-300">
        </div>
        <span class="text-xl font-bold bg-gradient-to-r from-gray-800 via-blue-600 to-indigo-600 bg-clip-text text-transparent">
            {{ $company_brand->company_brand_name ?? 'Brand Name' }}
        </span>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto px-2 space-y-1">
        @foreach ($User_navigation as $item)
            @php
                $linkUrl = $item->route_name ? route($item->route_name) : ($item->url ?? '#');
                $isActive = request()->url() === $linkUrl ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900';
            @endphp
            @if($item->is_active)
                <a href="{{ $linkUrl }}" target="{{ $item->target }}"
                   class="flex items-center space-x-2 px-4 py-3 rounded-lg transition-all duration-200 {{ $isActive }}">
                    @if($item->icon)
                        <i class="{{ $item->icon }} text-lg"></i>
                    @endif
                    <span>{{ $item->name }}</span>

                    @if($item->name === 'Cart')
                        <span id="cart-count"
                              class="ml-auto inline-block bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full hidden">
                            0
                        </span>
                    @elseif($item->name === 'Wishlist')
                        <span id="wishlist-count"
                              class="ml-auto inline-block bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded-full hidden">
                            0
                        </span>
                    @endif
                </a>
            @endif
        @endforeach
    </nav>
</aside>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script src=""></script>
<script>
    function UpdateCartCount() {
    $.ajax({
        url: "{{ route('User.cart.count') }}",
        type: "GET",
        success: function (response) {
            if (response.count > 0) {
                $("#cart-count").text(response.count).removeClass("hidden");
            } else {
                $("#cart-count").addClass("hidden");
            }
        }
    });
}

function UpdateWishlistCount() {
    $.ajax({
        url: "{{ route('User.wishlist.count') }}",
        type: "GET",
        success: function (response) {
            if (response.count > 0) {
                $("#wishlist-count").text(response.count).removeClass("hidden");
            } else {
                $("#wishlist-count").addClass("hidden");
            }
        }
    });
}

$(document).ready(function () {
    UpdateCartCount();
    UpdateWishlistCount();
});

</script>

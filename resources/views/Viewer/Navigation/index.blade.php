<nav class="bg-white/95 backdrop-blur-lg text-gray-800 border-b border-gray-200/60 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 py-3.5 flex justify-between items-center">

    <!-- Logo -->
    <div class="flex items-center space-x-3 group">
      <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-xl blur-md opacity-0 group-hover:opacity-40 transition-opacity duration-300"></div>
        <img src="{{ asset($brand->company_brand_logo ?? '') }}"
             alt="{{ $brand->company_brand_name ?? '' }} Logo"
             class="relative h-11 w-11 object-contain rounded-xl ring-2 ring-gray-200 group-hover:ring-blue-300 transition-all duration-300">
      </div>
      <span class="text-2xl font-bold bg-gradient-to-r from-gray-800 via-blue-600 to-indigo-600 bg-clip-text text-transparent">
        {{ $brand->company_brand_name ?? '' }}
      </span>
    </div>

    <!-- Desktop Links -->
    <ul class="hidden md:flex items-center space-x-2 text-sm font-medium">
      @foreach ($links ?? [] as $item)
        @php
          $linkUrl = $item->route_name ? route($item->route_name) : $item->url;
        @endphp
        @if($item->is_active)
          <li>
            <a href="{{ $linkUrl }}"
               target="{{ $item->target }}"
               class="px-4 py-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 relative group flex items-center space-x-2">
              @if($item->icon)
                <i class="{{ $item->icon }} text-lg"></i>
              @endif
              <span class="relative z-10">{{ $item->name }}</span>
              <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
            </a>
          </li>
        @endif
      @endforeach
    </ul>

    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button"
            class="md:hidden relative h-10 w-10 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
      <svg class="w-6 h-6 text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  <!-- Mobile Overlay -->
  <div id="mobile-menu-overlay" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-40 md:hidden"></div>

  <!-- Mobile Menu Drawer -->
  <div id="mobile-menu" class="fixed top-0 left-0 w-full h-screen md:hidden transform -translate-y-full transition-transform duration-300 z-50">
    <div class="bg-white/95 backdrop-blur-lg h-full shadow-lg overflow-y-auto">
      <div class="flex justify-between items-center p-6 border-b border-gray-200">
        <span class="text-xl font-bold">{{ $brand->company_brand_name ?? '' }}</span>
        <button id="mobile-menu-close" class="h-10 w-10 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
          ✕
        </button>
      </div>
      <ul class="flex flex-col p-6 space-y-2">
        @foreach ($links ?? [] as $item)
          @php
            $linkUrl = $item->route_name ? route($item->route_name) : $item->url;
          @endphp
          @if($item->is_active)
            <li>
              <a href="{{ $linkUrl }}"
                 target="{{ $item->target }}"
                 class="block px-4 py-3 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 flex items-center space-x-2">
                @if($item->icon)
                  <i class="{{ $item->icon }} text-lg"></i>
                @endif
                <span>{{ $item->name }}</span>
              </a>
            </li>
          @endif
        @endforeach
      </ul>
    </div>
  </div>
</nav>

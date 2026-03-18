<footer class="bg-white/95 backdrop-blur-lg text-gray-800 border-t border-gray-200/60 relative z-10 shadow-sm py-16 px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- Brand + About -->
        <div class="space-y-4">
            <div class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-xl blur-md opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                    <img src="{{ asset($brand->company_brand_logo ?? '') }}"
                         alt="{{ $brand->company_brand_name ?? 'Logo' }}"
                         class="relative h-12 w-12 object-contain rounded-xl ring-2 ring-gray-200 group-hover:ring-blue-300 transition-all duration-300">
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-gray-800 via-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    {{ $brand->company_brand_name ?? 'Brand Name' }}
                </span>
            </div>
            <p class="text-sm leading-relaxed text-gray-700">
                {{ $brand->company_brand_description ?? 'Premium eyewear with modern design and perfect vision.' }}
            </p>
        </div>

        <!-- Quick Links -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">Quick Links</h3>
            <ul class="space-y-2">
                @forelse($links as $item)
                    @if (!in_array($item->name, ['Register', 'Login', 'Contact']))
                        @php
                            $linkUrl = $item->route_name ? route($item->route_name) : $item->url;
                        @endphp
                        <li>
                            <a href="{{ $linkUrl ?? '#' }}"
                               target="{{ $item->target ?? '_self' }}"
                               class="px-3 py-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 relative group inline-block">
                                <span class="relative z-10">{{ $item->name ?? 'Link' }}</span>
                                <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            </a>
                        </li>
                    @endif
                @empty
                    <li class="text-gray-500 text-sm">No links available</li>
                @endforelse
            </ul>
        </div>

        <!-- Contact + Social -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">Contact & Follow</h3>
            <ul class="space-y-2 text-sm">
                @forelse($contact as $key => $value)
                    <li>
                        <span class="font-medium capitalize">{{ $key }}:</span> {{ $value ?? 'N/A' }}
                    </li>
                @empty
                    <li>No contact info available</li>
                @endforelse
            </ul>
            <div class="flex space-x-4 mt-2 text-2xl">
                @forelse($socials as $item)
                    <a href="{{ $item->social_platform_link ?? '#' }}" target="_blank"
                       class="hover:text-blue-500 transition-colors"
                       aria-label="{{ $item->social_platform_name ?? 'Social Link' }}">
                        <i class="{{ $item->social_platform_icon ?? 'fa fa-globe' }}"></i>
                    </a>
                @empty
                    <p class="text-sm mt-2 text-gray-500">No social links</p>
                @endforelse
            </div>
        </div>

    </div>


    <!-- Divider -->
    <div class="border-t border-gray-200 mt-10 pt-6 text-center text-sm text-gray-500">
        {{ $copyright->copyrights_description ?? '© ' . date('Y') . ' Brand Name. All rights reserved.' }}
    </div>
</footer>

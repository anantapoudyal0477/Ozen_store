<footer class="bg-white/95 backdrop-blur-lg text-gray-800 border-t border-gray-200/60 relative z-10 shadow-sm py-12 px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- Brand + Description -->
        <div class="space-y-4">
            <div class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-xl blur-md opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                    <img src="{{ asset($company_brand->company_brand_logo ?? 'default-logo.png') }}"
                         alt="{{ $company_brand->company_brand_name ?? 'Brand' }}"
                         class="relative h-12 w-12 object-contain rounded-xl ring-2 ring-gray-200 group-hover:ring-blue-300 transition-all duration-300">
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-gray-800 via-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    {{ $company_brand->company_brand_name ?? 'Brand Name' }}
                </span>
            </div>
            <p class="text-sm leading-relaxed text-gray-700">
                {{ $company_brand->company_brand_description ?? 'Premium eyewear with modern design and perfect vision.' }}
            </p>
        </div>

        <!-- Contact + Social -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">Contact & Follow</h3>

            <!-- Contact Info -->
            <ul class="space-y-2 text-sm">
                @if(!empty($contacts))
                    <li><strong>Phone:</strong> {{ $contacts->Phone ?? 'N/A' }}</li>
                    <li><strong>Email:</strong> {{ $contacts->Email ?? 'N/A' }}</li>
                    <li><strong>Address:</strong> {{ $contacts->Address ?? 'N/A' }}</li>
                @else
                    <li>No contact info available</li>
                @endif
            </ul>

            <!-- Social Icons -->
            <div class="flex space-x-4 mt-3 text-2xl">
                @foreach ($socials ?? [] as $social)
                    <a href="{{ $social->social_platform_link ?? '#' }}" target="_blank"
                       class="hover:text-blue-500 transition-colors" aria-label="Social Link">
                        <i class="{{ $social->social_platform_icon ?? 'fa fa-globe' }}"></i>
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Divider -->
    <div class="border-t border-gray-200 mt-10 pt-6 text-center text-sm text-gray-500">
        {{ $copyright->copyrights_description ?? '© ' . date('Y') . ' Brand Name. All rights reserved.' }}
    </div>
</footer>

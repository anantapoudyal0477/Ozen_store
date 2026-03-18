@extends('index')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 via-indigo-500/5 to-purple-600/10"></div>

        <div class="relative bg-cover bg-center min-h-[600px] flex items-center"
            style="background-image: linear-gradient(135deg, rgba(59, 130, 246, 0.85) 0%, rgba(99, 102, 241, 0.75) 100%), url('{{ asset('assets/images/homepage/eyeglasses-hero.jpg') }}');">

            <div class="container mx-auto px-6 py-20">
                <div class="max-w-3xl">
                    @if (!empty($HomeHeroData) && isset($HomeHeroData[0]))
                        @php $hero = $HomeHeroData[0]; @endphp

                        <!-- Badge -->
                        @if(!empty($hero->badge_text))
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-medium mb-6 border border-white/30">
                                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                {{ $hero->badge_text }}
                            </div>
                        @endif

                        <!-- Heading -->
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                            {{ $hero->title }}
                            @if(!empty($hero->subtitle))
                                <span class="block bg-gradient-to-r from-yellow-200 via-pink-200 to-purple-200 bg-clip-text text-transparent">
                                    {{ $hero->subtitle }}
                                </span>
                            @endif
                        </h1>

                        <!-- Description -->
                        @if(!empty($hero->description))
                        <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed">
                            {{ $hero->description }}
                        </p>
                        @endif

                    @else
                        <div class="text-white/80 text-center py-20">
                            No hero data available
                        </div>
                    @endif

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('Products.index') }}"
                            class="relative px-8 py-4 rounded-xl font-semibold shadow-xl flex items-center gap-2 bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-600 text-white hover:scale-105 transform transition-all duration-300">
                            <span>Shop Collection</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>

                        <a href="#features"
                            class="px-8 py-4 bg-white/10 backdrop-blur-md text-white border-2 border-white/30 rounded-xl font-semibold hover:bg-white/20 transition-all duration-300">
                            Learn More
                        </a>
                    </div>

                    <!-- Stats -->
                    @if(!empty($HomeStatsData))
                        <div class="grid grid-cols-3 gap-6 mt-12 pt-12 border-t border-white/20">
                            @foreach ($HomeStatsData as $stat)
                                @if(!empty($stat->label) && !empty($stat->value))
                                <div>
                                    <div class="text-3xl font-bold text-white mb-1">{{ $stat->value }}</div>
                                    <div class="text-sm text-white/80">{{ $stat->label }}</div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-20 right-20 w-72 h-72 bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Features Section -->
    @if(!empty($HomeFeaturesData))
    <div id="features" class="container mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                Why Choose Us
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Excellence in Every Frame
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Experience the perfect blend of fashion, comfort, and precision optics.
            </p>
        </div>

        <!-- Feature Grid -->
        <!-- Feature Grid -->
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($HomeFeaturesData as $feature)
                @if(!empty($feature->title) && !empty($feature->description))
                <div class="group relative
                            bg-gradient-to-br from-{{ $feature->bg_gradient_from ?? 'blue' }}-50 to-{{ $feature->bg_gradient_to ?? 'indigo' }}-50
                            rounded-2xl p-8 hover:shadow-xl transition-all duration-300
                            border border-{{ $feature->bg_gradient_from ?? 'blue' }}-100 hover:border-{{ $feature->bg_gradient_from ?? 'blue' }}-300">

                    <!-- Decorative circle -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $feature->bg_gradient_from ?? 'blue' }}-500/10 rounded-full blur-2xl
                                group-hover:bg-{{ $feature->bg_gradient_from ?? 'blue' }}-500/20 transition-all"></div>

                    <div class="relative">
                        <!-- Icon -->
                        <div class="w-14 h-14 bg-gradient-to-br from-{{ $feature->bg_gradient_from ?? 'blue' }}-500 to-{{ $feature->bg_gradient_to ?? 'indigo' }}-600
                                    rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            {!! $feature->icon_svg ?? '' !!}
                        </div>

                        <!-- Title -->
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $feature->title }}</h3>

                        <!-- Description -->
                        <p class="text-gray-600 leading-relaxed">{{ $feature->description }}</p>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    @if(!empty($HomeCTAData) && isset($HomeCTAData[0]))
        @php $cta = $HomeCTAData[0]; @endphp
        <div class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 py-20 overflow-hidden">
            <div class="container mx-auto px-6 relative z-10 text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    {{ $cta->heading ?? 'No Data Available' }}
                </h2>
                <p class="text-xl text-white/90 mb-10">
                    {{ $cta->description ?? "Browse our curated collection and discover eyewear that's uniquely you." }}
                </p>
                <a href="{{ route('Products.index') }}"
                   class="inline-flex items-center gap-3 px-10 py-5 bg-white text-blue-600 rounded-xl font-bold text-lg shadow-2xl hover:shadow-white/20 hover:scale-105 transform transition-all duration-300">
                    <span>{{ $cta->button_text ?? 'Explore Collection' }}</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <!-- Decorative Circles -->
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        </div>
    @endif

@endsection

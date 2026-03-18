@props(['title', 'count', 'color' => 'blue', 'gradient' => null, 'id' => null])

@php
    // Set default gradient if not passed
    $bgClass = $gradient ?? match($color) {
        'blue' => 'from-blue-500 to-blue-700',
        'green' => 'from-green-500 to-green-700',
        'purple' => 'from-purple-500 to-purple-700',
        'orange' => 'from-orange-500 to-red-500',
        default => 'from-gray-500 to-gray-700',
    };
@endphp

<div @if($id) id="{{ $id }}" @endif class="group relative bg-gradient-to-br {{ $bgClass }} p-6 rounded-3xl shadow-2xl overflow-hidden cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-{{ $color }}-500/50">
    <div class="absolute inset-0 bg-white/5 backdrop-blur-sm"></div>
    <div class="relative z-10">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <svg class="w-5 h-5 text-white/70 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
        <h2 class="text-white/90 text-sm font-semibold uppercase tracking-wider mb-2">
        <a href="{{ route($route_name) }}">
{{-- {{$route_name}} --}}
            {{ $title }}
        </a>
        </h2>
        <p class="text-5xl font-black text-white">{{ $count }}</p>
    </div>
    <div class="absolute bottom-0 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-8 translate-y-8 group-hover:scale-150 transition-transform duration-500"></div>
</div>

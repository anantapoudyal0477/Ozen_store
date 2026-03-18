@extends('index')

{{-- Escape title for safety --}}
@section('title', e($pageTitle ?? 'Services'))

@section('content')

    <!-- Hero Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white py-32">
        <div class="container mx-auto text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Services</h1>
            <p class="text-lg md:text-xl text-white/80 mb-6">
                Quality eyewear and professional eye care for your vision needs.
            </p>
        </div>
    </section>

    <!-- Eyeglasses Services Section -->
    @if(!empty($servicesList) && count($servicesList) > 0)
        @include('Viewer.Components.Services.ServicesCard', ['servicesList' => $servicesList])
    @else
        <div class="max-w-md mx-auto mt-8 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg shadow-md">
            <p class="font-semibold">No services available.</p>
            <p class="text-sm">Please check back later.</p>
        </div>
    @endif

@endsection

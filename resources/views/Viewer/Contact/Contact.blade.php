@extends('index')

@section('title', $pageTitle ?? 'Contact Us')

@section('content')
    <!-- Contact Section -->
    <section class="container mx-auto px-4 py-16 md:flex md:gap-12">
        <!-- Contact Form -->
      

        <!-- Shop Contact Info -->
        <div class="md:flex-1 mt-10 md:mt-0">
            <h3 class="text-2xl font-bold mb-4">Our Contact Info</h3>
            <ul class="space-y-4 text-gray-700">
                <li class="flex items-center gap-3">
                    <i class="fas fa-phone text-blue-500"></i>
                    <span>{{ $contact['Phone'] ?? 'N/A' }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <i class="fas fa-envelope text-blue-500"></i>
                    <span>{{ $contact['Email'] ?? 'N/A' }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <i class="fas fa-map-marker-alt text-blue-500"></i>
                    <span>{{ $contact['Address'] ?? 'N/A' }}</span>
                </li>
            </ul>
            <p class="mt-6 text-gray-600">
                We are happy to assist you with your eyewear needs.
            </p>
        </div>
    </section>

@endsection

@extends('index')

@section('title', $pageTitle ?? 'Contact Us')

@section('content')
<!-- Contact Section -->
<section class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-16">
    
    <div class="max-w-xl w-full bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-2xl transition duration-300">
        
        <h3 class="text-3xl font-bold text-gray-800 mb-6">
            Our Contact Info
        </h3>

        <ul class="space-y-6 text-gray-700">
            
            <li class="flex items-center justify-center gap-3">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-phone text-blue-500 text-lg"></i>
                </div>
                <span class="text-lg font-medium">
                    {{ $contact['Phone'] ?? 'N/A' }}
                </span>
            </li>

            <li class="flex items-center justify-center gap-3">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-envelope text-blue-500 text-lg"></i>
                </div>
                <span class="text-lg font-medium">
                    {{ $contact['Email'] ?? 'N/A' }}
                </span>
            </li>

            <li class="flex items-center justify-center gap-3">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-map-marker-alt text-blue-500 text-lg"></i>
                </div>
                <span class="text-lg font-medium">
                    {{ $contact['Address'] ?? 'N/A' }}
                </span>
            </li>

        </ul>

        <p class="mt-8 text-gray-500 text-sm">
            We are happy to assist you with your eyewear needs.
        </p>

    </div>

</section>
@endsection
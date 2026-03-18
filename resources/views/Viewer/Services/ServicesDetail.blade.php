@extends('index')

@section('title', e(optional($services)->name ?? 'Services'))

@section('content')

<div class="max-w-3xl mx-auto mt-10 p-8 bg-white shadow-xl rounded-2xl border border-gray-200">
    @if ($services)
        <!-- Service Header -->
        <div class="text-center mb-6">
            <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $services->name }}</h3>
            <div class="w-24 mx-auto border-b-4 border-blue-500 mb-4"></div>
            <p class="text-gray-600 leading-relaxed">
                {{ $services->description }}
            </p>
        </div>

        <!-- Info Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-xl border border-blue-200 flex items-start space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M15 6h6m-3-3v6M4 6h6M7 3v6m2 8h10m-6 0v4m-4-4v4m-6-4h10" />
            </svg>
            <p class="text-gray-700 text-md leading-relaxed">
                To receive this service, please create an account and book an appointment through our online system or visit our store directly.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex justify-center space-x-4">
            <a href="{{ route('Register.index') }}"
               class="px-6 py-3 rounded-lg bg-blue-600 text-white shadow hover:bg-blue-700 transition duration-200">
               Register Now
            </a>

        </div>

    @else
        <!-- Error Message -->
        <div class="text-center p-6 bg-red-50 border border-red-400 rounded-xl shadow-md">
            <h4 class="text-lg font-semibold text-red-700">Service not found.</h4>
            <p class="text-sm text-red-600 mt-2">The requested service could not be located. Please try again.</p>
            <a href="{{ route('services.list') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                ← Back to Services
            </a>
        </div>
    @endif
</div>

@endsection

@extends('index')

@section('title', 'Page Not Found')

@section('content')
<div class="min-h-[70vh] flex flex-col items-center justify-center text-center px-6 py-12">

    {{-- Icon --}}
    <div class="mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
             class="w-24 h-24 text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M12 9v4m0 4h.01M3.055 11a9.003 9.003 0 0117.89 0A9.003 9.003 0 013.055 11z" />
        </svg>
    </div>

    {{-- Heading --}}
    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-3">404 - Page Not Found</h1>

    {{-- Subtext --}}
    <p class="text-gray-600 text-lg max-w-xl mb-6">
        Oops! The page you're looking for doesn't exist, was removed, or is temporarily unavailable.
    </p>

    {{-- Buttons --}}
    <div class="flex flex-col md:flex-row gap-4">
        <a href="{{ route('Index') }}"
           class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
            Go to Homepage
        </a>

    </div>


</div>
@endsection

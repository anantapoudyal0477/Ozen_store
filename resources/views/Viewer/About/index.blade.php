@extends('index')

@section('title', $pageTitle ?? 'About Us')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-32">
    <div class="container mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">About Us</h1>
        <p class="text-lg md:text-xl text-white/80 mb-6">
            Learn more about our mission, vision, and the services we provide.
        </p>
    </div>
</section>
<!-- About Section -->
<section class="py-16 container mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-8">
        @forelse ($aboutData as $data)
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300">
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">{{ e($data->about_topic_title) }}</h3>
                <p class="text-gray-600">{{ e($data->about_topic_description) }}</p>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-2">No about content found.</p>
        @endforelse
    </div>
</section>

@endsection

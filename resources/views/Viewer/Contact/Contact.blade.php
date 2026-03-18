@extends('index')

@section('title', $pageTitle ?? 'Contact Us')

@section('content')
    <!-- Contact Section -->
    <section class="container mx-auto px-4 py-16 md:flex md:gap-12">
        <!-- Contact Form -->
        <div class="md:flex-1 bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Contact Us</h2>
            <form action="{{ route('Contact.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                    <textarea name="message" id="message" rows="5" placeholder="Write your message..."
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

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

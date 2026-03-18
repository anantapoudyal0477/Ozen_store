@extends('index')

@section('title', $pageTitle ?? 'Staff Login')

@section('content')
<div class="flex justify-center items-center flex-1 py-10">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl flex overflow-hidden">
        <div class="w-1/2 hidden md:block">
            <img src="{{ asset('assets/images/login/login-side.jpg') }}" alt="Eyeglasses" class="h-full w-full object-cover">
        </div>
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Staff Login</h2>

            <form action="{{ route('StaffLogin.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>
                <div>
                    <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

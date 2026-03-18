@extends('index')

@section('title', $pageTitle ?? 'Home')

@section('content')

    <!-- Register Section -->
    <div class="flex justify-center items-center flex-1 py-10">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl flex overflow-hidden">

            <!-- Left side: Image -->
            <div class="w-1/2 hidden md:block">
                <img src="{{ asset('assets/Images/Register/Register-side.jpg') }}"
                     alt="Eyeglasses" class="h-full w-full object-cover">
            </div>

            <!-- Right side: Form -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-2xl font-bold mb-6 text-center">Create Account</h2>

                <form id="registerForm" action="{{ route('Register.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your full name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition">
                            Register
                        </button>
                    </div>
                </form>

                <!-- Already a user -->
                <p class="mt-4 text-center text-gray-600">
                    Already a user?
                    <a href="{{ route('Login.index') }}" class="text-blue-500 hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var url = form.attr('action');
                console.log(url);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        alert(response.message); // Show success message
                        form[0].reset(); // Reset the form
                        //redirect to login page
                        window.location.href = "{{ route('Login.index') }}";
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText); // Show error message
                    }
                });
            });
        });

    </script>

@endsection

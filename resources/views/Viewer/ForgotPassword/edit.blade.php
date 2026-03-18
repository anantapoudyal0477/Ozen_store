@extends('index')

@section('title', e($pageTitle ?? 'Products'))
@section('content')
<div class="flex justify-center items-center py-10">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Reset Password</h2>

        @include('Viewer.Components.Messages.Error_Messages')
        @include('Viewer.Components.Messages.Success_Messages')

        <form method="POST" action="{{ route('reset-password.submit') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email"
                       class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">New Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <button class="w-full bg-green-600 text-white py-2 rounded-lg">
                Update Password
            </button>
        </form>
    </div>
</div>

@endsection

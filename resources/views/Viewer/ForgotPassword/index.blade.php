@extends('index')

@section('title', e($pageTitle ?? 'Products'))

@section('content')

<div class="flex justify-center items-center py-10">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>

        @include('Viewer.Components.Messages.Error_Messages')
        @include('Viewer.Components.Messages.Success_Messages')

        <form method="POST" action="{{ route('forgot-password.verify') }}">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-2">Enter your email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit"
                class="mt-4 w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                Send Password Reset Link
            </button>
        </form>
    </div>
</div>
@endsection


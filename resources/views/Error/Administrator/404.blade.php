@extends('administrator.admin-layout-page')

@section('title', 'Page Not Found')

@section('content')
sdfas
<div class="text-center py-20">
    <h1>Admin 404</h1>
    <h1 class="text-6xl font-bold text-red-600">404</h1>
    <p class="mt-4 text-xl text-gray-600">Oops! The page you are looking for doesn’t exist.</p>
    <a href="{{ route('Administrator.Homepage.Index') }}" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
        Go Home
    </a>
</div>
@endsection

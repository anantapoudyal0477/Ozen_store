@extends('Administrator.admin-layout-page')

@section('title', $pageTitle)

@section('content')

<pre>
    {{ $admin }}
</pre>
<div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md text-center">
    <h1 class="text-3xl font-bold mb-6">Welcome, {{ $admin->name }}!</h1>

    <div class="text-left space-y-3 mb-6">
        <p><strong>Email:</strong> {{ $admin->email }}</p>
        <p><strong>Address:</strong> {{ $admin->address ?? 'Not set' }}</p>
        <p><strong>Phone:</strong> {{ $admin->phone ?? 'Not set' }}</p>
        <p><strong>User Type:</strong> {{ $admin->user_type }}</p>
        <p><strong>Joined:</strong> {{ $admin->created_at->format('d M, Y') }}</p>
    </div>

    <form action="{{ route('Administrator.logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded transition">
            Logout
        </button>
    </form>
</div>
@endsection

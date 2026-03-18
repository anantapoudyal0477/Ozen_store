<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

<input type="checkbox" id="sidebar-toggle" class="hidden peer" />

<!-- Mobile overlay -->
<label for="sidebar-toggle"
       class="fixed inset-0 bg-black/30 z-40 hidden peer-checked:block lg:hidden"></label>

<!-- Sidebar -->
@include('administrator.Navigation.index')

<!-- App Shell -->
<div class="lg:pl-72 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="sticky top-0 z-30 bg-white border-b border-gray-200">
        <div class="h-16 px-6 flex items-center justify-between">

            <!-- Mobile toggle -->
            <label for="sidebar-toggle"
                   class="lg:hidden p-2 rounded-md hover:bg-gray-100 cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </label>

            <!-- Page title -->
            <h1 class="text-lg font-semibold tracking-tight">
                @yield('title')
            </h1>

            <!-- Right actions -->
            <div class="flex items-center gap-3">
                <button class="p-2 rounded-md hover:bg-gray-100">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2"
                              d="M15 17h5l-1.4-1.4A2 2 0 0118 14V11a6 6 0 00-4-5.6V5a2 2 0 10-4 0v.3A6 6 0 006 11v3a2 2 0 01-.6 1.4L4 17h5"/>
                    </svg>
                </button>

                <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-semibold">
                    @php
                    $admin = Auth::guard("admins")->user();
                    $adminName = $admin->name;
                    $capitalOfAdminName = str_split($adminName)[0];
                    @endphp
                    {{$capitalOfAdminName}}
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1 p-6 max-w-[1600px] w-full mx-auto">
        <div class="mb-6">
            @include('administrator.components.messages.index')
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-white">
        <div class="px-6 py-4 text-sm text-gray-500 flex justify-between">
            <span>© 2024 Admin</span>
            <span>Built with Laravel</span>
        </div>
    </footer>

</div>

</body>
</html>

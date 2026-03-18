<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description', 'Premium eyewear and optical solutions')">
    <meta name="keywords" content="@yield('keywords', 'eyeglasses, sunglasses, optical, eyewear')">

    <title>@yield('title', 'Premium Eyewear')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #60a5fa, #818cf8); border-radius:5px; }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #3b82f6, #6366f1); }
        .dark ::-webkit-scrollbar-track { background: #1e293b; }
        @keyframes fadeIn { from {opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }
        .fade-in { animation: fadeIn 0.6s ease-out; }

    </style>

    @stack('styles')
</head>

<body class="min-h-screen flex flex-col antialiased">

    <!-- Navigation -->
    <header class="sticky top-0 z-50 shadow-md bg-white dark:bg-gray-900">
        @include('Viewer.Navigation.index', ['NavigationData' => $NavigationData ?? [], 'CompanyBrandData' => $CompanyBrandData ?? []])
    </header>

    <!-- Main Content -->
    <main id="main-content" class="flex-grow relative fade-in z-0">
        <div id="messageBox">
            @include('Viewer.components.messages.index')
        </div>
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="mt-auto bg-gray-100 dark:bg-gray-900">
        @include('Viewer.Footer.index', ['FooterData' => $FooterData ?? []])
    </footer>


    <!-- Back to Top Button -->
    <button id="back-to-top"
            class="fixed bottom-8 right-8 z-50 h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 opacity-0 invisible flex items-center justify-center group"
            aria-label="Back to top">
        <svg class="w-6 h-6 transform group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Scripts -->
    <script>
        // Back to Top
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0','invisible');
                backToTopButton.classList.add('opacity-100','visible');
            } else {
                backToTopButton.classList.add('opacity-0','invisible');
                backToTopButton.classList.remove('opacity-100','visible');
            }
        });
        backToTopButton.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));

        // Dark mode toggle
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        if(darkModeToggle){
            darkModeToggle.addEventListener('click',()=>{
                document.documentElement.classList.toggle('dark');
                localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
            });
            if(localStorage.getItem('darkMode')==='true') document.documentElement.classList.add('dark');
        }
    </script>

    @stack('scripts')
</body>
</html>

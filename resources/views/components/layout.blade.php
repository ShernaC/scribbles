<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post-it!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('css/form.css') }}"> --}}
    
</head>
<body>
    @if(session('success'))
        <div id="notification" class="fixed top-4 right-4 z-50 bg-primary-600 text-white px-4 py-2 rounded-lg shadow-lg text-sm font-medium transform transition-all duration-300 ease-in-out">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @elseif (session('fail'))
        <div id="notification" class="fixed top-4 right-4 z-50 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg text-sm font-medium transform transition-all duration-300 ease-in-out">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('fail') }}</span>
            </div>
        </div>
    @endif

    @auth
    <button id="hamburger-btn" class="fixed top-5 left-5 z-50 hover:bg-gray-100 p-3 rounded-md transition-colors duration-300 flex flex-col gap-1.5">
        <span class="hamburger-line w-6 h-0.5 bg-primary-600 transition-all duration-300 rounded "></span>
        <span class="hamburger-line w-6 h-0.5 bg-primary-600 transition-all duration-300 rounded "></span>
        <span class="hamburger-line w-6 h-0.5 bg-primary-600 transition-all duration-300 rounded "></span>
    </button>

    <nav id="sidebar" class="fixed top-0 -left-80 w-80 h-screen bg-primary-700 text-white z-40 transition-all duration-300 shadow-lg">
        <div class="flex justify-between items-center p-5 border-b border-primary-700">
            <h3 class="text-xl font-semibold">Menu</h3>
            <button id="close-btn" class="text-white hover:bg-white hover:bg-opacity-5 w-8 h-8 rounded-full flex items-center justify-center text-2xl transition-colors duration-300">
                &times;
            </button>
        </div>
        
        
        <div class="py-5">
            <a href="{{ route('home')}}" class="flex items-center px-5 py-4 text-white hover:bg-primary-600 transition-colors duration-300 no-underline">                 
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">                     
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m0 0V11a1 1 0 011-1h2a1 1 0 011 1v10m0 0h3a1 1 0 001-1V10M9 21h6"></path>                 
                </svg>                 
                <span>Homepage</span>             
            </a>      
            
            <a href="{{ route('post.all')}}" class="flex items-center px-5 py-4 text-white hover:bg-primary-600 transition-colors duration-300 no-underline">                 
                 <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M12 2a10 10 0 100 20 10 10 0 000-20zm2.5 7.5l-1.086 4.342a1 1 0 01-.72.72L8.5 15.5l1.086-4.342a1 1 0 01.72-.72L14.5 9.5z"></path>
                </svg>               
                <span>Browse</span>             
            </a>

            <a href="{{ route('user')}}" class="flex items-center px-5 py-4 text-white hover:bg-primary-600 transition-colors duration-300 no-underline">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profile</span>
            </a>

            <a href="{{ route('post.getAll')}}" class="flex items-center px-5 py-4 text-white hover:bg-primary-600 transition-colors duration-300 no-underline">                 
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">                     
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>                 
                </svg>                 
                <span>My Posts</span>             
            </a>
                        
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="flex items-center w-full px-5 py-4 text-white hover:bg-primary-600 transition-colors duration-300 border-none bg-transparent cursor-pointer text-left">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 backdrop-blur-sm bg-opacity-10 z-30 opacity-0 invisible transition-all duration-300"></div>
    @endauth
    <!-- Main Content -->
    <main class="container pt-20 transition-all duration-300">
        {{ $slot }}
    </main>
</body>
</html>


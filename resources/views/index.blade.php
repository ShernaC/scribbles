<x-layout>
        <div class="min-h-[calc(100vh-4rem)] flex items-center justify-center p-6">
            <div class="max-w-md mx-auto text-center space-y-12">
                <!-- Header -->
                <div class="space-y-6">
                    <h1 class="text-6xl text-gray-800 tracking-tight">
                        Scribbles! 
                    </h1>
                    <p class="text-xl text-gray-500 font-light">
                        A simple app to post and share your thoughts.
                    </p>
                </div>

                <!-- Action buttons -->
                @guest
                    <div class="items-center space-x-8">
                        <a href="{{ route('show.login')}}" 
                        class="py-4 text-gray-500 font-medium hover:text-primary-600 transition-colors duration-300">
                            Sign In
                        </a>
                        <a href="{{ route('show.register')}}" 
                        class="py-4 text-gray-500 font-medium hover:text-primary-600 transition-colors duration-300">
                            Create Account
                        </a>
                    </div>
                @endguest

                @auth
                    <div class="items-center space-x-8">
                        <a href="{{ route('show.create')}}" 
                        class="py-4 text-gray-500 font-medium hover:text-primary-600 transition-colors duration-300">
                            Create Post
                        </a>
                        <a href="{{ route('post.all')}}" 
                        class="py-4 text-gray-500 font-medium hover:text-primary-600 transition-colors duration-300">
                            Browse
                        </a>
                        <a href="{{ route('post.getAll')}}" 
                        class="py-4 text-gray-500 font-medium hover:text-primary-600 transition-colors duration-300">
                            View My Posts
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-layout>
<x-layout>
    <div class="container mx-auto px-4 py-8">
        @if($posts->count() > 0)
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 text-center mb-2">All Posts</h1>
                <p class="text-gray-600 text-center">Browse through your posts</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 px-16">
                @foreach($posts as $post)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        <div class="h-32 relative {{$post->image ? '' : 'bg-gradient-to-r from-green-500 to-sky-600'}}">
                            @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="User Image" class="w-full h-full object-cover rounded-t-lg" >
                            @endif
                            <div class="absolute bottom-2 left-4 right-4">
                                <span class="inline-block px-2 py-1 bg-white bg-opacity-90 text-xs font-semibold text-gray-800 rounded-full">
                                    Post #{{ $loop->iteration }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-primary-600 transition-colors">
                                <a href="{{ route('post.get', $post->id) }}" class="hover:underline">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($post->content, 120) }}
                            </p>

                            <div class="text-xs text-gray-500 mb-4">
                                <i class="far fa-calendar mr-1"></i>
                                {{ $post->created_at->format('M j, Y') }}
                                <span class="mx-2">•</span>
                                <i class="far fa-clock mr-1"></i>
                                {{ Str::wordCount($post->content) }} words
                            </div>

                            <div class="flex justify-between items-center">
                                <a href="{{ route('post.get', $post->id) }}" 
                                   class="inline-flex items-center py-2 text-sm font-medium text-primary-600 hover:text-primary-800 transition-colors">
                                    <i class="fas fa-eye mr-1"></i>
                                    Read More
                                </a>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('show.update', $post->id) }}" 
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 hover:text-primary-600 transition-colors">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('post.delete', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this post?')"
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-600 hover:text-red-800 transition-colors">
                                            <i class="fas fa-trash mr-1"></i>
                                            Delete
                                        </button>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-file-alt text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No posts found</h3>
                <p class="text-gray-600 mb-6">There are no posts to display at the moment.</p>
                <a href="{{ route('show.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Create Your First Post!
                </a>
            </div>
        @endif

        <a 
            href="{{ route('show.create') }}"
            class="fixed bottom-6 right-6 bg-primary-600 hover:bg-primary-700 text-white font-bold p-4 rounded-full shadow-lg transition-all duration-200 z-50 hover:scale-105 transform inline-flex items-center justify-center"
            aria-label="Add new item"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </a>
    </div>
</x-layout>
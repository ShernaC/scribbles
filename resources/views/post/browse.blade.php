<x-layout>
    {{-- @extends('components.layout')
    @section('content') --}}
         <div class="container mx-auto px-4 py-8">
        @if($posts->count() > 0)
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 text-center mb-2">All Posts</h1>
                <p class="text-gray-600 text-center">Browse posts by others and you!</p>
            </div>
                         
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 px-16">
                @foreach($posts as $post)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden cursor-pointer" onclick="openModal({{ $post->id }})">
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
                                {{ $post->title }}
                            </h2>
                             
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($post->content, 120) }}
                            </p>
                             
                            <div class="text-xs text-gray-500 mb-4">
                                <div class="flex items-center mb-2">
                                    <i class="far fa-user mr-1"></i>
                                    <span class="font-medium text-gray-700">{{ $post->user->name ?? 'Unknown Author' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="far fa-calendar mr-1"></i>
                                    {{ $post->created_at->format('M j, Y') }}
                                    <span class="mx-2">•</span>
                                    <i class="far fa-clock mr-1"></i>
                                    {{ Str::wordCount($post->content) }} words
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden data for modal -->
                    <div id="post-data-{{ $post->id }}" style="display: none;">
                        <div data-title="{{ $post->title }}"></div>
                        <div data-content="{{ $post->content }}"></div>
                        @if($post->image)
                        <div data-image="{{ asset('storage/' . $post->image) ?? '' }}"></div>
                        @endif
                        <div data-author="{{ $post->user->name ?? 'Unknown Author' }}"></div>
                        <div data-date="{{ $post->created_at->format('M j, Y \a\t g:i A') }}"></div>
                        <div data-words="{{ Str::wordCount($post->content) }}"></div>
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
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="postModal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-4 
            backdrop-blur-sm bg-black/30 transition-all duration-300 ease-out">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
            <!-- Close button -->
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl z-10">
                <i class="fas fa-times"></i>
            </button>
            
            <!-- Modal header -->
            <div class="bg-gradient-to-r from-green-500 to-sky-600 p-6 text-white">
                <h2 id="modalTitle" class="text-2xl font-bold pr-8"></h2>
            </div>
            
            <!-- Modal body -->
            <div class="p-6">
                <!-- Author and date info -->
                <div class="flex items-center text-sm text-gray-600 mb-6 pb-4 border-b border-gray-200">
                    <div class="flex items-center mr-6">
                        <i class="far fa-user mr-2"></i>
                        <span id="modalAuthor" class="font-medium"></span>
                    </div>
                    <div class="flex items-center mr-6">
                        <i class="far fa-calendar mr-2"></i>
                        <span id="modalDate"></span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        <span id="modalWords"></span>&nbsp;words
                    </div>
                </div>

                <!-- Post image -->
                <div id="modalImageContainer" class="mb-6" style="display: none;">
                    <img id="modalImage" src="" alt="Post Image" class="w-full object-cover rounded">
                </div>

                <!-- Post content -->
                <div id="modalContent" class="text-gray-800 leading-relaxed 
                                                break-words overflow-wrap-anywhere hyphens-auto 
                                                whitespace-pre-wrap max-w-full overflow-x-hidden
                                                prose prose-sm max-w-none
                                                prose-p:mb-4 prose-headings:break-words 
                                                prose-a:break-all prose-a:text-blue-600 prose-a:hover:text-blue-800
                                                prose-code:bg-gray-100 prose-code:px-1 prose-code:py-0.5 prose-code:rounded prose-code:break-all prose-code:whitespace-pre-wrap
                                                prose-pre:bg-gray-100 prose-pre:p-3 prose-pre:rounded prose-pre:overflow-x-auto prose-pre:break-all">
                </div>
            </div>
            
            <!-- Modal footer -->
            <div class="px-6 py-4 flex justify-end">
                <button onclick="closeModal()" class="px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
   
    {{-- @include('post.create') --}}

</x-layout>
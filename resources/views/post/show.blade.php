<x-layout>
    <div>
        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 md:p-8">
                    <header class="mb-8">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                            {{ $post->title }}
                        </h1>
                    </header>

                    <div class="max-w-200">
                        <img id="image" src="{{ asset('storage/' . $post->image) }}" alt="User Image">
                    </div>

                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed space-y-6">
                            {{ $post->content }}
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('post.getAll') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            Back to Posts
                        </a>
                        <a href="{{ route('post.update', $post->id) }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md shadow-sm text-sm font-medium hover:bg-primary-700 transition-colors">
                            Edit Post
                        </a>
                    </div>
                </div>
            </article>
        </main>
    </div>
</x-layout>
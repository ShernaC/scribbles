<x-layout>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">       
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">           
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">               
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">                   
                    Create Post            
                </h1>
                <h2 class="text-center text-gray-500">
                    What do you have in mind?
                </h2>               
                <form class="space-y-4 md:space-y-6" action="{{ route('post.create') }}" method="POST" >    
                    @csrf     
                    <div>                       
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title: </label>                       
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400" placeholder="My First Post" required>                   
                    </div>             
                    <div class="w-full max-w-2xl mx-auto">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900"></label>
                        <textarea name="content" id="content" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400 resize-vertical" placeholder="This is my very first post." required></textarea>
                    </div>                                               
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>                       
                    
                    <!-- validation errors -->
                    @if ($errors->any())
                        <ul class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 rounded-md list-none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </form>           
            </div>       
        </div>   
    </div> 
</x-layout>
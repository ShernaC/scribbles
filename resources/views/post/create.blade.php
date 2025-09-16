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
                <form id="post-form" class="space-y-4 md:space-y-6" action="{{ route('post.create') }}" method="POST">    
                    @csrf     
                    <div>                       
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title: </label>                       
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400" placeholder="My First Post" required>                   
                    </div>             
                    <div class="w-full max-w-2xl mx-auto">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900"></label>
                        <textarea name="content" id="content" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400 resize-vertical" placeholder="This is my very first post." required></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="image" class="cursor-pointer inline-flex items-center py-2 hover:text-primary-700 text-primary-600 font-medium rounded-lg transition-colors duration-200">
                            Upload Image
                        </label>
                        <input id="image" name="image" type="file" accept="image/*" class="hidden" onchange="handleImageSelect(this)">
                    </div>
                    <div id="preview-container" class="hidden">
                        <h3 class="block mb-2 text-sm font-medium text-gray-900">Preview</h3>
                        <div class="relative">
                            <img id="image-preview" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg border">
                            <button type="button" onclick="removeImage()" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div id="file-info" class="mt-2 text-sm text-gray-600"></div>
                    </div>
                    <input type="hidden" id="uploaded_image_path" name="uploaded_image_path">                                             
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
    
    <script>
        const form = document.getElementById('post-form');
        document.addEventListener("submit", function(e){
            e.preventDefault();
        }) ;

        function handleImageSelect(input) {
            const image = input.files[0];
            if (image) {
                selectedImage = image;
                displayImagePreview(image);
                uploadImage(image);
            }
        }

        function displayImagePreview(file) {
            const reader = new FileReader;
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');

                const fileInfo = `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`
                document.getElementById('file-info').textContent = fileInfo;
            };
            reader.readAsDataURL(file);
        }

        function uploadImage(file) {
            const formData = new FormData();
            formData.append('image', file);

            // Ajax request
            $.ajax({
                url: "{{ route('post.upload') }}",
                type: 'POST',
                data: formData, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, 
                contentType: false,
                success: function(data) {
                    console.log('Success: Image is valid');

                    if (data.data.url) {
                        $('#image-preview').attr('src', data.data.url);
                    }

                    if (data.data.path) {
                        $('#uploaded_image_path').val(data.data.path);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("=== AJAX ERROR ===");
                    console.error("Status:", status);
                    console.error("Error:", error);
                    console.error("Response Text:", xhr.responseText);

                    try {
                        let json = JSON.parse(xhr.responseText);
                        console.log("Parsed JSON:", json);
                    } catch (e) {
                        console.warn("Response is not valid JSON");
                    }
                }
            });
        }

        function removeImage() {
            selectedImage = null;
            uploadedImagePath = null;
            document.getElementById('preview-container').classList.add('hidden');
            document.querySelectorAll('input[type="file"]').forEach(input => input.value = '');
        }

    </script>
</x-layout>
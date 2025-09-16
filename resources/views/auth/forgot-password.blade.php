<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scribbles</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if (session('error'))
        <div id="notification" class="fixed top-4 right-4 z-50 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg text-sm font-medium transform transition-all duration-300 ease-in-out">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">       
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">           
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">               
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">                   
                    Reset Your Password              
                </h1>
                <h2>
                    Enter the email associated with your account. You will receive an email message with instructions on how to reset your password. 
                </h2>
                <form class="space-y-4 md:space-y-6" action="{{ route('password.email') }}" method="POST" >    
                    @csrf                
                    <div>                       
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email: </label>                       
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400" placeholder="name@company.com" required>                   
                    </div>                                               
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset Password</button>                        
                    
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
</body>
</html>
    
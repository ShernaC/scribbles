<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post-it!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">       
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">           
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">               
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">                   
                    Log in to your account               
                </h1>               
                <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST" >    
                    @csrf                
                    <div>                       
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email: </label>                       
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400" placeholder="name@company.com" value= "{{ old('email') }}" required>                   
                    </div>                   
                    <div>    
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password: </label>                       
                            <a href="{{ route('password.request') }}" 
                            class="group text-sm font-medium text-primary-800 hover:text-primary-600 transition duration-150 ease-in-out">
                                <span class="flex items-center">
                                    {{ __('Forgot password?') }}
                                </span>
                            </a>
                        </div>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-400" required>                   
                    </div>                                    
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>                        
                    <p class="text-sm font-light text-gray-500">                       
                        Don't have an account yet? <a href="{{ ROUTE('register') }}" class="font-medium text-primary-600 hover:underline">Sign up</a>                   
                    </p>  
                    
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
    
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
                    Check your email   
                </h1>
                <h2>
                    We've sent a password reset link to your email address. Please check your inbox and click the link to reset your password.
                </h2>
                <div class="text-left bg-primary-50 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-primary-900 mb-2">Next steps:</h3>
                    <ul class="text-sm text-primary-800 space-y-1">
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">1.</span>
                            Check your email inbox (and spam folder)
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">2.</span>
                            Click the "Reset Password" link in the email
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">3.</span>
                            Create your new password
                        </li>
                    </ul>
                </div>
            </div>       
        </div>   
    </div> 
</body>
</html>
    
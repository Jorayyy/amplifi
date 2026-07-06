<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amplifi - Employee Advocacy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen relative antialiased selection:bg-teal-500 selection:text-white">
    
    <!-- Top Right Navigation Links -->
    <div class="absolute top-0 right-0 p-6 text-right z-10">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-slate-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-500 mr-4">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-slate-900 bg-teal-400 hover:bg-teal-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition ease-in-out duration-150">Register</a>
                @endif
            @endauth
        @endif
    </div>

    <!-- Center Landing Content -->
    <div class="text-center px-4">
        <h1 class="text-5xl font-extrabold text-teal-400 mb-4 tracking-tight">
            🚀 Amplifi
        </h1>
        <p class="text-slate-400 text-lg max-w-md mx-auto">
            Automating employee incentives and tracking content sharing for Account-Based Marketing.
        </p>
    </div>
</body>
</html>

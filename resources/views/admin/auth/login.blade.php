<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Sign In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-950 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Beautiful modern background blobs -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute -top-[10%] -left-[10%] w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-40"></div>
        <div class="absolute top-[20%] -right-[10%] w-[500px] h-[500px] bg-purple-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-40"></div>
        <div class="absolute -bottom-[20%] left-[20%] w-[600px] h-[600px] bg-blue-600 rounded-full mix-blend-multiply filter blur-[128px] opacity-30"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Glassmorphism Card -->
        <div class="bg-slate-900/60 backdrop-blur-xl border border-white/10 p-8 sm:p-10 rounded-3xl shadow-2xl relative overflow-hidden">
            
            <!-- Subtle glow effect inside top -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-80"></div>

            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-500/20 text-indigo-400 mb-4 backdrop-blur-sm border border-indigo-500/30 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white tracking-tight">Admin Portal</h2>
                <p class="text-slate-400 mt-2 text-sm font-medium">Please sign in to continue</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 backdrop-blur-md border border-red-500/30 text-red-200 px-4 py-3 rounded-xl shadow-lg ring-1 ring-inset ring-red-500/20">
                    <div class="flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-sm text-red-300">Authentication Failed</span>
                    </div>
                    <ul class="list-disc list-inside text-xs mt-1 ml-1 pl-1 opacity-90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf
                <div class="space-y-1.5">
                    <label class="block text-slate-300 text-sm font-semibold tracking-wide ml-1" for="email">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500 group-focus-within:text-indigo-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-slate-800/60 border border-slate-700/60 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300 shadow-inner" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                    </div>
                </div>
                
                <div class="space-y-1.5">
                    <label class="block text-slate-300 text-sm font-semibold tracking-wide ml-1" for="password">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500 group-focus-within:text-indigo-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-slate-800/60 border border-slate-700/60 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300 shadow-inner" id="password" type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-600 bg-slate-800 text-indigo-500 outline-none focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-0 transition-colors cursor-pointer">
                        <label for="remember" class="ml-2.5 block text-sm text-slate-400 font-medium cursor-pointer hover:text-slate-300 transition-colors">
                            Remember me
                        </label>
                    </div>
                </div>
                
                <button class="w-full py-3.5 px-4 mt-4 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-400 hover:to-purple-500 text-white font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/60 focus:ring-offset-2 focus:ring-offset-slate-900 transform transition-all duration-300 hover:-translate-y-0.5 shadow-lg shadow-indigo-500/25 active:scale-[0.98]" type="submit">
                    Sign In to Dashboard
                </button>
            </form>
            
            <div class="mt-8 text-center pt-6 border-t border-slate-700/50">
                <p class="text-xs text-slate-500">&copy; {{ date('Y') }} DyWix Studio. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>

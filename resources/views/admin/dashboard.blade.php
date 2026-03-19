<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center shadow-md">
        <div class="text-xl font-bold">Admin Panel</div>
        <div>
            <span class="mr-4">Welcome, {{ auth()->guard('admin')->user()->name ?? 'Admin' }}</span>
            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded font-bold transition">Logout</button>
            </form>
        </div>
    </nav>
    
    <div class="container mx-auto mt-8 p-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard</h1>
            <p class="text-gray-600">You are logged in as an administrator.</p>
        </div>
    </div>
</body>
</html>

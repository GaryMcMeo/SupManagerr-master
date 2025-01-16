<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="text-2xl font-bold text-gray-800">
                    Pilar Inventory Management
                </div>

                <!-- Navigation -->
                <nav>
                    <ul class="flex space-x-6">
                        <!-- Home -->
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 font-medium">Home</a>
                        </li>
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Dashboard</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Search for Products</h1>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('search') }}">
                <div class="flex items-center border border-gray-300 rounded-md overflow-hidden">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Search for products..." 
                        class="flex-grow px-4 py-2 text-gray-800 focus:outline-none"
                        required
                    />
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>

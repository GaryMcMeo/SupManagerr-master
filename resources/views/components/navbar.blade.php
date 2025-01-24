<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="text-2xl font-bold text-blue-500">
                <a href="{{ route('dashboard') }}">Pilar Inventory</a>
            </div>
            <!-- Navigation Links -->
            <div class="flex space-x-4">
                <!-- Home Link -->
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'text-blue-500 font-semibold' : 'text-gray-600' }} hover:text-blue-500">
                    Home
                </a>

                <!-- Product Link -->
                <a href="{{ route('products.index') }}"
                class="{{ request()->routeIs('products.index') ? 'text-blue-500 font-semibold' : 'text-gray-600' }} hover:text-blue-500">
                 Product
             </a>

                <!-- Category Link -->
                <a href="{{ route('categories.create') }}"
                   class="{{ request()->routeIs('categories.create') ? 'text-blue-500 font-semibold' : 'text-gray-600' }} hover:text-blue-500">
                    Category
                </a>
            </div>
        </div>
    </div>
</nav>

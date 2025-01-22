<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">

            <!-- Success Message -->
            @if(session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Welcome to Pilar Inventory System</h1>

            <p class="mb-4">Hello, {{ auth()->user()->name }}!</p>

            <!-- Quick links to manage products -->
            <div class="mb-6">
                <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Product</a>
            </div>

            <div class="mb-6">
                <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Category</a>
            </div>

            <!-- Quick Stats Section -->
            <div class="grid grid-cols-2 gap-6 mb-6">
                
                <!-- Ringkasan Produk -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Ringkasan Produk</h2>
                    <ul class="list-disc ml-4">
                        <li>Total Produk: <!-- {{ $totalProducts ?? '0' }} --></li>
                        <li>Produk Aktif: <!-- {{ $activeProducts ?? '0' }} --></li>
                        <li>Stok Total: <!-- {{ $totalStock ?? '0' }} --></li>
                    </ul>
                    <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline text-sm">Lihat Semua</a>
                </div>

                <!-- Last Activity -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Aktivitas Terakhir</h2>
                    <ul class="list-disc ml-4">
                        <!-- Loop aktivitas terakhir produk -->
                        @foreach($recentActivities ?? [] as $activity)
                            <li>{{ $activity->description }} ({{ $activity->created_at->diffForHumans() }})</li>
                        @endforeach
                        <!-- Placeholder jika tidak ada data -->
                        @if(empty($recentActivities))
                            <li class="text-gray-500 text-sm">Tidak ada aktivitas terbaru.</li>
                        @endif
                    </ul>
                </div>
            </div>

                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Stok Hampir Habis</h2>
                    <ul class="list-disc ml-4">
                        @foreach($lowStockProducts as $product)
                            <li>{{ $product->name }} (Sisa {{ $product->stock }})</li>
                        @endforeach
                        @if($lowStockProducts->isEmpty())
                            <li class="text-gray-500 text-sm">Semua stok aman.</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Products Table (Paginated) -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Product Name</th>
                            <th class="px-4 py-2 text-left">Quantity</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->stock }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                    </form>
                                    <form action="{{ route('products.decrease', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Decrease</button>
                                    </form>
                                    <form action="{{ route('products.increase', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Increase</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination links -->
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

</body>
</html>

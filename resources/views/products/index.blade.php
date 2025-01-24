<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('components.navbar')

    <div class="max-w-7xl mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Product List</h1>

            <!-- Button to Add Product -->
            <div class="mb-6">
                <a href="{{ route('products.create') }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Add Product
                </a>
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
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                       class="inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
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

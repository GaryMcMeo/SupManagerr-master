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
                <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add New Product</a>
            </div>

            <!-- Products Table -->
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
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                    <form action="{{ route('products.decrease', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-yellow-500 hover:text-yellow-700">Decrease</button>
                                    </form>
                                    <form action="{{ route('products.increase', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:text-green-700">Increase</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>

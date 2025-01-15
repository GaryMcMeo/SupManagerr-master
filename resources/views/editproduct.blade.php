<!-- resources/views/products/editproduct.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">

            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Edit Product</h1>

            <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="flex flex-col">
                    <label for="name" class="text-gray-600">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="p-2 border border-gray-300 rounded-md">
                </div>

                <div class="flex flex-col">
                    <label for="stock" class="text-gray-600">Stock Quantity</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="p-2 border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Product</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>

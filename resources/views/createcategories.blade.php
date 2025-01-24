<!-- resources/views/products/createcategories.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Create New Category</h1>

            <!-- Button to go back to Dashboard -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Back to Dashboard
                </a>
            </div>

            <!-- Form for creating a new category -->
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                
                <!-- Category Name -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-gray-800">Category Name</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Category</button>
            </form>

        </div>
    </div>

</body>
</html>

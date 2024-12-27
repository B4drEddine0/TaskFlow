<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-auto p-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-indigo-600">TaskFlow</h1>
                <p class="text-gray-600 mt-2">Manage your tasks efficiently</p>
            </div>


            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="user.php" method="POST">
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter your name">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter your email">
                        </div>

                        <button 
                            type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-200">
                            Start Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 
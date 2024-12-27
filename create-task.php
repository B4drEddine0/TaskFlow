<?php
require_once 'taskClass.php';
$taskManager = new Tasks();
$users = $taskManager->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Create Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-indigo-600">TaskFlow</h1>
                    </div>
                    <div class="flex items-center">
                        <a href="tasks.php" class="text-gray-600 hover:text-gray-900">Back to Tasks</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Create New Task</h2>
                
                <form action="process.php" method="POST" class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Task Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Task Type</label>
                        <select 
                            id="type" 
                            name="type"
                            class="type w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Basic">Basic Task</option>
                            <option value="Bug">Bug</option>
                            <option value="Feature">Feature</option>
                        </select>
                    </div>

                    <div class='bug hidden'>
                        <label for="critere" class="block text-sm font-medium text-gray-700 mb-2">Critère</label>
                        <textarea 
                            id="critere" 
                            name="critere" 
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Describe the bug criteria..."></textarea>
                    </div>

                    <div class='feat hidden'>
                        <label for="requirement" class="block text-sm font-medium text-gray-700 mb-2">Requirement</label>
                        <textarea 
                            id="requirement" 
                            name="requirement" 
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="List the feature requirements..."></textarea>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select 
                            id="status" 
                            name="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="todo">To Do</option>
                            <option value="in-progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div>
                        <label for="assign_to" class="block text-sm font-medium text-gray-700 mb-2">Assign To</label>
                        <select 
                            id="assign_to" 
                            name="assign_to"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select User</option>
                            <?php foreach($users as $user): ?>
                                <option value="<?php echo htmlspecialchars($user['username']); ?>">
                                    <?php echo htmlspecialchars($user['username'] . ' (' . $user['email'] . ')'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="tasks.php" 
                           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Create Task
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        const typeSelect = document.getElementById('type');
        const bugDiv = document.querySelector('.bug');
        const featDiv = document.querySelector('.feat');

        typeSelect.addEventListener('change', function() {
            if(this.value == 'Bug') {
                bugDiv.classList.remove('hidden');
            } else if(this.value == 'Feature') {
                bugDiv.classList.add('hidden');
                featDiv.classList.remove('hidden');
            } else {
                bugDiv.classList.add('hidden');
                featDiv.classList.add('hidden');
            }
        });
</script>
</body>
</html>
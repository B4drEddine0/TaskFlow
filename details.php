<?php
require_once 'taskClass.php';

if (!isset($_GET['id'])) {
    header('Location: tasks.php');
    exit();
}

$taskId = $_GET['id'];
$tasks = new Tasks();
$taskDetails = $tasks->getTaskDetails($taskId);

if (!$taskDetails) {
    header('Location: tasks.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Task Details</title>
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
                        <a href="tasks.php" class="text-gray-600 hover:text-gray-900">
                            ← Back to Tasks
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900"><?php echo htmlspecialchars($taskDetails['title']); ?></h2>
                            <p class="text-sm text-gray-500 mt-1">Created on <?php echo date('F j, Y', strtotime($taskDetails['createdAt'])); ?></p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <?php echo htmlspecialchars($taskDetails['statut']); ?>
                        </span>
                    </div>
                </div>

                <div class="px-6 py-4 space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-600">
                            <?php echo htmlspecialchars($taskDetails['taskDescription']); ?>
                        </p>
                    </div>

                    <?php if($taskDetails['taskType'] === 'Bug' && isset($taskDetails['critere'])): ?>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Bug Criteria</h3>
                        <p class="text-gray-600">
                            <?php echo htmlspecialchars($taskDetails['critere']); ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php if($taskDetails['taskType'] === 'Feature' && isset($taskDetails['requirement'])): ?>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Feature Requirements</h3>
                        <p class="text-gray-600">
                            <?php echo htmlspecialchars($taskDetails['requirement']); ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Task Type</h4>
                            <p class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($taskDetails['taskType']); ?></p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Assigned To</h4>
                            <p class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($taskDetails['assignedTo']); ?></p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Status</h4>
                            <p class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($taskDetails['statut']); ?></p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Created Date</h4>
                            <p class="mt-1 text-sm text-gray-900"><?php echo date('M j, Y', strtotime($taskDetails['createdAt'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
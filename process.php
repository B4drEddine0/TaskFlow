<?php
require_once 'taskClass.php';
require_once 'bugClass.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $assignedTo = $_POST['assign_to'];
    
    if($type == 'Bug') {
        $task = new bug();
        $task->setTitle($title);
        $task->setDescription($description);
        $task->setStatus($status);
        $task->setType($type);
        $task->setAssignedTo($assignedTo);
        $task->setCritere($_POST['critere']);
        $task->AddBug();

    } else {
        $task = new Tasks();
        $task->setTitle($title);
        $task->setDescription($description);
        $task->setStatus($status);
        $task->setType($type);
        $task->setAssignedTo($assignedTo);
        $task->AddTask();
        
    }
    header('location: tasks.php');
}
?>
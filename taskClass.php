<?php
session_start();
require_once 'database.php';

class Tasks{

    protected $db;
    protected $title;
    protected $description;
    protected $status;
    protected $type;
    protected $assignedTo;

    public function __construct(){
        $database = new DbConnection();
        $this->db = $database->getConnection();
    }


    public function setTitle($title){
        $this->title = htmlspecialchars(strip_tags($title));
    }

    public function setDescription($description){
        $this->description = htmlspecialchars(strip_tags($description));
    }

    public function setStatus($status){
        $this->status = htmlspecialchars(strip_tags($status));
    }

    public function setType($type){
        $this->type = htmlspecialchars(strip_tags($type));
    }

    public function setAssignedTo($assignedTo){
        $this->assignedTo = htmlspecialchars(strip_tags($assignedTo));
    }

    
    public function AddTask(){
        $query = 'insert into task (title, taskDescription, statut, taskType, assignedTo, user_id) values (:title, :taskDescription, :statut, :taskType, :assignedTo, :user_id)';
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':taskDescription',$this->description);
        $stmt->bindParam(':statut',$this->status);
        $stmt->bindParam(':taskType',$this->type);
        $stmt->bindParam(':assignedTo',$this->assignedTo);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        $stmt->execute();

        // if($stmt->execute()){
        //     header('location: tasks.php');
        // }else{
        //     echo 'erreur while creating task';
        // }
    }

    public function GetTasks(){
        $query = "SELECT title, taskDescription, statut, createdAt FROM task WHERE user_id = :user_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $title = htmlspecialchars($row['title']);
                $description = htmlspecialchars($row['taskDescription']);
                $status = htmlspecialchars($row['statut']);
                $createdAt = htmlspecialchars($row['createdAt']);
                
                echo '<div class="bg-white rounded-lg shadow p-6">';
                echo '    <div class="flex justify-between items-start mb-4">';
                echo '        <h3 class="text-lg font-medium text-gray-900">' . $title . '</h3>';
                echo '        <span class="px-2 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">' . $status . '</span>';
                echo '    </div>';
                echo '    <p class="text-gray-600 mb-4">' . $description . '</p>';
                echo '    <div class="flex justify-between items-center text-sm text-gray-500">';
                echo '        <span>Due: ' . date('M d, Y', strtotime($createdAt)) . '</span>';
                echo '        <button class="text-indigo-600 hover:text-indigo-800">View Details</button>';
                echo '    </div>';
                echo '</div>';
            }}
    }

}
?>
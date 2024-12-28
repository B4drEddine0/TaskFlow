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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id']) && isset($_POST['status'])) {
            if($this->updateStatus($_POST['task_id'], $_POST['status'])) {
                header('Location: tasks.php');
                exit();
            }
        }

        $query = "SELECT task_id, title, taskDescription, statut, taskType, createdAt FROM task WHERE user_id = :user_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $title = htmlspecialchars($row['title']);
                $description = htmlspecialchars($row['taskDescription']);
                $status = htmlspecialchars($row['statut']);
                $type = htmlspecialchars($row['taskType']);
                $createdAt = htmlspecialchars($row['createdAt']);
                
                $borderColor = match($type) {
                    'Bug' => 'border-red-500',
                    'Feature' => 'border-blue-500',
                    default => 'border-gray-200'
                };
                
                echo '<div class="bg-white rounded-lg shadow p-6 border-l-4 ' . $borderColor . '">';
                echo '    <div class="flex justify-between items-start mb-4">';
                echo '        <h3 class="text-lg font-medium text-gray-900">' . $title . '</h3>';
                echo '        <div class="flex items-center space-x-2">';
                echo '            <span class="text-sm text-gray-500">' . $type . '</span>';
                echo '            <form action="tasks.php" method="POST" class="inline">';
                echo '                <input type="hidden" name="task_id" value="' . $row['task_id'] . '">';
                echo '                <select name="status" onchange="this.form.submit()" 
                                    class="px-2 py-1 text-sm rounded-full border ' . 
                                    ($status === 'todo' ? 'bg-gray-100 text-gray-800' : 
                                    ($status === 'in-progress' ? 'bg-yellow-100 text-yellow-800' : 
                                        'bg-green-100 text-green-800')) . '">';
                echo '                    <option value="todo" ' . ($status === 'todo' ? 'selected' : '') . '>To Do</option>';
                echo '                    <option value="in-progress" ' . ($status === 'in-progress' ? 'selected' : '') . '>In Progress</option>';
                echo '                    <option value="done" ' . ($status === 'done' ? 'selected' : '') . '>Done</option>';
                echo '                </select>';
                echo '            </form>';
                echo '        </div>';
                echo '    </div>';
                echo '    <p class="text-gray-600 mb-4">' . $description . '</p>';
                echo '    <div class="flex justify-between items-center text-sm text-gray-500">';
                echo '        <span>Created: ' . date('M d, Y', strtotime($createdAt)) . '</span>';
                echo '        <a href="details.php?id=' . $row['task_id'] . '" class="text-indigo-600 hover:text-indigo-800">View Details</a>';
                echo '    </div>';
                echo '</div>';
            }}
    }

        public function getTaskDetails($taskId) {
            $query = "SELECT t.*, b.critere, f.requirement 
                    FROM task t 
                    LEFT JOIN bug b ON t.task_id = b.task_id 
                    LEFT JOIN feature f ON t.task_id = f.task_id 
                    WHERE t.task_id = :task_id AND t.user_id = :user_id";
                    
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    public function getUsers() {
        $query = "SELECT user_id, username, email FROM user";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($taskId, $newStatus) {
            $query = "UPDATE task 
                     SET statut = :status 
                     WHERE task_id = :task_id 
                     AND user_id = :user_id";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':status', $newStatus);
            $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

            if($stmt->execute()) {
                return true;
            }
            return false;
    }
}


    

?>
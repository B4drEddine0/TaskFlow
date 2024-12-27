<?php
require_once 'database.php';
require_once 'taskClass.php';


class feature extends Tasks{

    protected $requirement;

    public function setRequirement($requirement){
        $this->requirement = htmlspecialchars(strip_tags($requirement));
    }
    

    public function AddFeat(){  
            parent::AddTask();
            $lastTaskId = $this->db->lastInsertId();
            
            $query = 'insert into feature (requirement, task_id) values (:requirement, :task_id)';
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':requirement', $this->requirement);
            $stmt->bindParam(':task_id', $lastTaskId);
            
            if($stmt->execute()) {
                header('location: tasks.php');
            } else {
                echo 'Error while creating bug record';
            }
    }
}

?>
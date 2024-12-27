<?php
require_once 'database.php';
require_once 'taskClass.php';


class bug extends Tasks{

    protected $critere;

    public function setCritere($critere){
        $this->critere = htmlspecialchars(strip_tags($critere));
    }
    

    public function AddBug(){  
            parent::AddTask();
            $lastTaskId = $this->db->lastInsertId();
            
            $query = 'insert into bug (critere, task_id) values (:critere, :task_id)';
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':critere', $this->critere);
            $stmt->bindParam(':task_id', $lastTaskId);
            
            if($stmt->execute()) {
                header('location: tasks.php');
            } else {
                echo 'Error while creating bug record';
            }
    }
}

// if(isset($_POST['critere'])){
//     $critere = $_POST['critere'];
//     $bug = new bug();
//     $bug->setCritere($critere);
//     $bug->AddTask();
// }

?>
<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    

    function getTasks($x)
    {
        //CODE HERE
        //SQL SELECT
        global $con;
        $sql ="SELECT tks.*,sts.name,tps.name,pts.name FROM tasks tks,statuses sts,types tps,priorities pts WHERE
         sts.id=tks.status_id AND pts.id=tks.priority_id AND tps.id=tks.type_id AND tks.status_id=$x";
		$result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_row($result)){
            echo"<li class='list-group-item d-flex' data-bs-toggle='modal' id='".$row[0]."' >";
                //echo"<i class='fa-solid fa-question ml-1 mt-1'></i>";
                echo"<div class='w-100' id='".$row[4]."'>";
                    echo"<div class='fs-3 fw-bold' id='title'>".$row[1]."</div>";
                    echo"<div>";
                        echo"<div>€ created in <span>".$row[5]."</span></div>";
                        echo"<div>".$row[6]."</div>";
                    echo"</div>";
                    echo"<div class='d-flex justify-content-between'>";
                        echo"<div>";
                            echo"<span class='badge rounded-pill bg-primary' id='".$row[3]."'>".$row[9]."</span>";
                            echo"<span class='badge rounded-pill bg-secondary' id='".$row[2]."'>".$row[8]."</span>";
                        echo"</div>";
                        echo"<div>";
                            echo"<button type='button' class='btn btn-light text-dark' onclick='edit(this)'  href='#modal-task' data-bs-toggle='modal'>Edit</button>";
                            //echo"<button type='button' class='btn btn-danger'>Delete</button>";
                        echo"</div>";
                
                    echo"</div>";
                echo"</div>";
                
            echo"</li>";

        }
        
     
     }

    function saveTask()
    {
        //CODE HERE
        //SQL INSERT
        global $con;
        $title=$_POST['title'];
		$date=$_POST['date'];
		$description=$_POST['description'];
		$priority=$_POST['priority'];
        $status=$_POST['status'];
		$type = $_POST['task_type'];
		$sql="INSERT INTO `tasks` (`title`, `task_datetime`, `description`, `priority_id`, `status_id`, `type_id`) 
        VALUES ('$title','$date','$description','$priority', '$status','$type')";
		mysqli_query($con,$sql);
        $_SESSION['message'] = "Task has been added successfully !";
		header('location: index.php');
    }

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        global $con;
        $title=$_POST['title'];
		$date=$_POST['date'];
		$description=$_POST['description'];
		$priority=$_POST['priority'];
        $status=$_POST['status'];
		$type = $_POST['task_type'];
        $task_id = $_POST['task_id'];
        $sql = "UPDATE `tasks` SET `title`='$title',`type_id`='$type',`priority_id`='$priority',
        `status_id`='$status',`task_datetime`='$date',`description`='$description' WHERE `id`='$task_id'";
        mysqli_query($con,$sql);
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask()
    {
        //CODE HERE
        //SQL DELETE
        global $con;
        $task_id = $_POST['task_id'];
        $sql ="DELETE FROM `tasks` WHERE `id`='$task_id'";
        mysqli_query($con,$sql);
        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }
<?php
    include('config/constants.php');

    //check task_id in URL
    if(isset($_GET['task_id']))
    {
        //delete the task from database
        //get the task id
        $task_id = $_GET['task_id'];

        //connect database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //select databse
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

        //sql query to delete task
        $sql = "DELETE FROM tbl_tasks WHERE task_id = $task_id";

        //execute query
        $res = mysqli_query($conn,$sql);

        //check if the query executed successfully or not
        if($res==TRUE)
        {
            //query executed successfully
            $_SESSION['delete'] = "task deleted successfully";

            //redirect to home page
            header('location:'.SITEURL);
        }
        else
        {
            //failed to delete task
            $_SESSION['delete_fail'] = "failed to delete task";

            //redirect to home page
            header('location:'.SITEURL);
        }

    }
    else
    {
        //redirect to home page
        header('location:'.SITEURL);
    }

?>
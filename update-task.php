<?php
    include('config/constants.php');

    //check the task id in URl
    if(isset($_GET['task_id']))
    {
        //get the values from database
        $task_id = $_GET['task_id'];

        //connect database
        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

        //select database
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

        //sql query to get the detail of selected task
        $sql = "SELECT * FROM tbl_tasks WHERE task_id = $task_id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //check if the query is executed successfully or not
        if($res==TRUE)
        {
            //query executed
            //get the data from databse and store it in an array
            $row = mysqli_fetch_assoc($res);

            //get the indivisual value
            $task_name = $row['task_name'];
            $task_description = $row['task_description'];
            $list_id = $row['list_id'];
            $priority = $row['priority'];
            $deadline = $row['deadline'];

        }
    }
    else
    {
        //redirect to home page
        header('location:'.SITEURL);
    }

?>

<html>
    <head>
        <title>Task Manager</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
    </head>

    <body>
        <div class="wrapper">
        <h1>Task Manager</h1>

        <p>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
        </p>

        <h3>Upadate Task Page</h3>

        <p>
            <?php
                if(isset($_SESSION['update_fail']))
                {
                    echo $_SESSION['update_fail'];
                    unset($_SESSION['update_fail']);
                }
            ?>
        </p>

        <form action="" method="POST">
            <table class="tbl-half">
                <tr>
                    <td>Task Name</td>
                    <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required></td>
                </tr>

                <tr>
                    <td>Task Description</td>
                    <td>
                        <textarea name="task_description" >
                            <?php  echo $task_description; ?>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Select List</td>
                    <td>
                        <select name="list_id">

                            <?php
                                //connect database
                                $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

                                //selct database
                                $db_select2 = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());
                            
                                //sql query to get list
                                $sql2 = "SELECT * FROM tbl_lists";

                                //execute query
                                $res2 = mysqli_query($conn2,$sql2);

                                //check if executed successfully or not
                                if($res2==TRUE)
                                {
                                    //display the lists
                                    //count rows 
                                    $count_rows2 = mysqli_num_rows($res2);

                                    //check whether list is update or not
                                    if($count_rows2>0)
                                    {
                                        //list are added
                                        while($row2=mysqli_fetch_assoc($res2))
                                        {
                                            //get indivisual value
                                            $list_id_db = $row2['list_id'];
                                            $list_name = $row2['list_name'];

                                            ?>
                                                <option <?php if($list_id_db==$list_id){echo "selected='selected'"; } ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>


                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //no list added
                                        //display none as option
                                        ?>
                                            <option <?php if($list_id=0){echo "selected='selected'";} ?> value="0">None</option>
                                        <?php
                                    }
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Priority</td>
                    <td>
                        <select name="priority">
                            <option <?php if($priority=="High"){echo "selected=''";}  ?> value="High">High</option>
                            <option <?php if($priority=="Medium"){echo "selected=''";}  ?> value="Medium">Medium</option>
                            <option <?php if($priority=="Low"){echo "selected=''";}  ?> value="Low">Low</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Deadline</td>
                    <td><input type="date" name="deadline" value="<?php echo $deadline; ?>"></td>
                </tr>

                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="Update"></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>

<?php
    //check if the button is clicked
    if(isset($_POST['submit']))
    {
        //get thevalues from form
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        //connect database
        $conn3 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

        //select databse
        $db_select3 = mysqli_select_db($conn3,DB_NAME) or die(mysqli_error());

        //create sql query to update task
        $sql3 = "UPDATE tbl_tasks SET
                task_name = '$task_name',
                task_description = '$task_description',
                list_id = '$list_id',
                priority = '$priority',
                deadline = '$deadline'
                WHERE 
                task_id = $task_id
        ";

        //execute query
        $res3 = mysqli_query($conn3,$sql3);
        
        //check whether the query executed or not
        if($res3==TRUE)
        {
            //query executed and task updated
            $_SESSION['update'] = "task updated successfully";

            //redirect to home page
            header('location:'.SITEURL);
        }
        else
        {
            //failed to update task
            $_SESSION['update_fail'] = "failed to update task";

            //redirect to this page
            header('location:'.SITEURL.'update-task.php?task_id='.$task_id);

        }
    }


?>
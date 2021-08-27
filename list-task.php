<?php
    include('config/constants.php');
    //get the list id fropm URL
    $list_id_url = $_GET['list_id'];

?>
<html>
    <head>
        <title>Task Manager</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
    </head>

    <body>
        <div class="wrapper">
        <h1>Task Manager</h1>

        <!-- Menu starts here -->
        <div class="menu">
                <a href="<?php echo SITEURL; ?>">Home</a>

                <?php
                    //comment displaying menu lists from databse
                    $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

                    //select databse 
                    $db_select2 = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());

                    //Sql query to get the list from databse
                    $sql2 = "SELECT * FROM tbl_lists";

                    //execute query
                    $res2 = mysqli_query($conn2, $sql2);

                    //check whether the query executed or not
                    if($res2==TRUE)
                    {
                        //display the list in menu
                        while($row2 = mysqli_fetch_assoc($res2))
                        {
                            $list_id = $row2['list_id'];
                            $list_name = $row2['list_name'];
                            ?>
                                <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                            <?php
                        }
                    }

                ?>
                

                <a href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>
            </div>
        <!-- Menu ends here -->

        <div class="all-task">
            <a class="btn-primary" href="<?php echo SITEURL; ?>add-task.php">Add Task </a>
        
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //connect databse
                    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

                    //select databse
                    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

                    //sql query to display class by list selected
                    $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";

                    //execute query
                    $res = mysqli_query($conn,$sql);
                    if($res==TRUE)
                    {
                        //display the task based on list
                        //count the rows 
                        $count_rows = mysqli_num_rows($res);

                        if($count_rows>0)
                        {
                            //we have task on this list
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //get indivisual value
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                $priority = $row['priority'];
                                $deadline = $row['deadline'];
                                ?>
                                <tr>
                                    <td>1.</td>
                                    <td><?php echo $task_name; ?></td>
                                    <td><?php echo $priority; ?></td>
                                    <td><?php echo $deadline; ?></td>
                                    <td>
                                        <a class="btn-update" href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>

                                        <a class="btn-delete" href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                    </td>
                                </tr>


                                <?php

                            }
                        }
                        else
                        {
                            //no task on this list
                            ?>
                                <tr>
                                    <td colspan="5">No task added on this list</td>
                                </tr>
                            <?php
                        }
                    }

                ?>

                
            </table>
        </div>
        </div>
    </body>
</html>
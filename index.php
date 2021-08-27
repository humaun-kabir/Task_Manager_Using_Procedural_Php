<?php
    include('config/constants.php');
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

        <!-- Task starts here -->

        <p>
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['delete_fail']))
                {
                    echo $_SESSION['delete_fail'];
                    unset($_SESSION['delete_fail']);
                }
            ?>
        </p>

        <div class="all-task">

            <a class="btn-primary" href="<?php echo SITEURL; ?>add-task.php">Add task</a>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <?php
                   
                   //connect database
                   $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

                   //select databse
                   $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

                   //craete sql query to set data from datbase
                   $sql = "SELECT * FROM tbl_tasks";

                   //execute query
                   $res = mysqli_query($conn, $sql);

                   //check whether the query executed or not
                   if($res==TRUE)
                   {
                       //display the task from database
                       //count the task on databse first
                       $count_rows = mysqli_num_rows($res);

                       //create serial number variable
                       $sn=1;

                       //check whether there is task on databse or not
                       if($count_rows>0)
                       {
                           //data is in database
                           while($row = mysqli_fetch_assoc($res))
                           {
                               $task_id = $row['task_id'];
                               $task_name = $row['task_name'];
                               $priority = $row['priority'];
                               $deadline = $row['deadline'];

                            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
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
                            //no data in database

                            ?>

                            <tr>
                                <td colspan="5">No task Added yet </td>
                            </tr>

                            <?php
                       }

                   }

                ?>

                
            </table>
        </div>

        <!-- Task ends here -->
        </div>
    </body>
</html>
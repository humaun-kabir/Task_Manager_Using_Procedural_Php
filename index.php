<?php
    include('config/constants.php');
?>
<html>
    <head>
        <title>Task Manager</title>
    </head>

    <body>
        <h1>Task Manager</h1>

        <!-- Menu starts here -->
            <div class="menu">
                <a href="<?php echo SITEURL; ?>">Home</a>
                <a href="#">To Do</a>
                <a href="#">Doing</a>
                <a href="#">Done</a>

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
            ?>
        </p>

        <div class="all-task">

            <a href="<?php echo SITEURL; ?>add-task.php">Add task</a>
            <table>
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
                                <a href="#">Update</a>

                                <a href="#">Delete</a>
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
    </body>
</html>
<?php
    include('config/constants.php');

    //get the current values of selected list
    if(isset($_GET['list_id']))
    {
        //get the list id value
        $list_id = $_GET['list_id'];

        //connect to databse
        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        
        //select database
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

        // query to get the values from database
        $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";

        //execute query
        $res = mysqli_query($conn,$sql);

        //check whether the executed successfully or not
        if($res==TRUE)
        {
            //get the value from database
            $row = mysqli_fetch_assoc($res);//value is in array

            //create indivisual variable to save the data
            $list_name = $row['list_name'];
            $list_description = $row['list_description'];
        }
        else
        {
            //go back to manage list page
            header('location:'.SITEURL.'manage-list.php');
        }
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

        <div>
            <a class="btn-secondary" href="<?php echo SITEURL ?>">Home</a>
            <a class="btn-secondary" href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>
        </div>

        <h3>Update List Page</h3>

        <p>
            <?php 
                //whether the session is set or not
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
                    <td>List Name</td>
                    <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required></td>
                </tr>

                <tr>
                    <td>List Description</td>
                    <td>
                        <textarea name="list_description" >
                            <?php echo $list_description; ?>
                        </textarea>
                    </td>
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
    //check whether the update button clicked or not
    if(isset($_POST['submit']))
    {
        //get the updated values from our from
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];

        //connect databse
        $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_errno());
        
        //select the databse
        $db_select2 = mysqli_select_db($conn2,DB_NAME);

        //query to update list
        $sql2 = "UPDATE tbl_lists SET
                list_name = '$list_name',
                list_description = '$list_description'
                WHERE list_id = $list_id
                 ";

        //execute the query
        $res2 = mysqli_query($conn2,$sql2);

        //check whether the query executed successfully or not
        if($res2==TRUE)
        {
            //upadet successfully
            //set themessage
            $_SESSION['update'] = "list updated successfully";
            
            //redirect to manage list page
            header('location:'.SITEURL.'manage-list.php');
        }
        else
        {
            //set session message
            $_SESSION['update_fail'] = "failed to update";

            //redirect to the update list page
            header('location:'.SITEURL.'update-list.php?list_id=$list_id'.$list_id);
        }
    }
?>
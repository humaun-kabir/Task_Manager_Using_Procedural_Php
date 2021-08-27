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

        <a class="btn-secondary" href="<?php echo SITEURL;  ?>">Home</a>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>

        <h3>Add List Page</h3>

        <p>
            <?php
                //check whether the session is set or not
                if(isset($_SESSION['add_fail']))
                {
                    //display session message
                    $_SESSION['add_fail'];
                    //remove the message after displaying the message once
                    unset($_SESSION['add_fail']);
                }
            ?>
        </p>

        <!-- Form to add list starts here -->
        <form action="" method="POST">
            <table class="tbl-half">
                <tr>
                    <td>List Name</td>
                    <td><input type="text" name="list_name" placeholder="Type list name" required></td>
                </tr>
                <tr>
                    <td>List Descrption</td>
                    <td><textarea name="list_description" placeholder="Type list description"></textarea></td>
                </tr>

                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="Save"></td>
                </tr>
            </table>
        </form>
        <!-- Form to add list ends here -->
        </div>
    </body>
</html>

<?php
    //check whether the form is submited or not
    if(isset($_POST['submit']))
    {
        //get gthe values and from form and save it in variables
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];

        //connect database
        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

        //check whether the database connected or not
        // if($conn==TRUE)
        // {

        // }
        //select database
        $db_select = mysqli_select_db($conn,DB_NAME);

        //check whether database connected or not
        // if($db_select==TRUE)
        // {

        // }
        //sql query to insert data into database
        $sql = "INSERT INTO tbl_lists SET
                list_name = '$list_name',
                list_description = '$list_description'
                ";
        //execute query and insert into database
        $res = mysqli_query($conn,$sql);

        //check whether the query successfully or not
        if($res==TRUE)
        {
            //create a session variable to display message
            $_SESSION['add'] = "List added successfully";

            //data inserted successfully and
            //redirect to manage list page
            header('location:'.SITEURL.'manage-list.php');

            
        }
        else
        {
            //create session to save message
            $_SESSION['add-fail'] = "fail to add list";
            //redirect to same page
            header('location:'.SITEURL.'add-list.php');
        }

    }

?>
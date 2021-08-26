<?php
    include('config/constants.php');

    //check whether the list_id is assign or not
    if(isset($_GET['list_id']))
    {
        //delete the list from database
        
        //get the list_id value from URL or get method
        $list_id = $_GET['list_id'];

        //connect the databse
        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

        //select databse
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

        //write the query to delete list from database
        $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

        //execute the result
        $res = mysqli_query($conn,$sql);

        //check whethe the query executed successfully or not
        if($res==TRUE)
        {
            //query executed successfully which means list is deleted successfully
            $_SESSION['delete'] = 'list deleted successfully';

            //redirect to manage list page
            header('location:'.SITEURL.'manage-list.php');
        }
        else{
            //failed to delete list
            $_SESSION['delete_fail'] = 'failed to delete list';
            header('location:'.SITEURL.'manage-list.php');
        }
    }
    else
    {
        //redirect to manage_list page
        header('location:'.SITEURL.'manage-list.php');
    }

    

    
?>
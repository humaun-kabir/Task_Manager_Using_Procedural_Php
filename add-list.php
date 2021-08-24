<html>
    <head>
        <title>Task Manager</title>
    </head>

    <body>
        <h1>Task Manager</h1>

        <a href="index.php">Home</a>
        <a href="manage-list.php">Manage List</a>

        <h3>Add List Page</h3>

        <!-- Form to add list starts here -->
        <form action="" method="POST">
            <table>
                <tr>
                    <td>List Name</td>
                    <td><input type="text" name="list_name" placeholder="Type list name"></td>
                </tr>
                <tr>
                    <td>List Descrption</td>
                    <td><textarea name="list_description" placeholder="Type list description"></textarea></td>
                </tr>

                <tr>
                    <td><input type="submit" name="submit" value="Save"></td>
                </tr>
            </table>
        </form>
        <!-- Form to add list ends here -->
    </body>
</html>
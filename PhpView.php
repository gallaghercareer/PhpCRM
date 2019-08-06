<!--
Author:John Gallagher
Purpose:The purpose of this program is to create an Employee Management System. The user should be
able to Create, Read, Update, and Delete employees from the system.
Date:8/5/2019
Resources: Udemy,
-->
<?php
require_once('PhpCrudDSN.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Employees</title>
    <link rel="stylesheet" href="CrudCss.css">
</head>
<body>

<!--
The h2 tag below Outputs the data in the _GET superglobal array (id imported from update page).
The "@" behind the $_GET['id'] means it cannot throw an error if there are no values found in the $_GET array.
-->
<h2 class="successInfo"> <?php echo htmlentities(@$_GET['id'], ENT_QUOTES | ENT_HTML5, 'UTF-8');; ?></h2>


<!--SEARCHBOX CODE-->
<div>
    <fieldset>
        <legend> Search Employee</legend>
    <form action="PhpView.php" method="GET">
        <input type="text" name="search" placeholder="Search by ID or Name">
        <input type="submit" name = "searchSubmit" value="Submit Search">
    </form>
    </fieldset>
</div>
<?php
if(isset($_GET['searchSubmit'])){
    $ConnectingDB;
    $search = $_GET['search'];
    $sql = "SELECT * FROM emp_record WHERE employeeName=:searcH or id=:searcH";
    $stmt=$ConnectingDB->prepare($sql);
    $stmt->bindValue(':searcH', $search);
    $stmt->execute();

    while($dataRows = $stmt->fetch()){
        $employeeName = $dataRows['employeeName'];
        $id = $dataRows['id'];
        $department = $dataRows['department'];
        $salary = $dataRows['salary'];
        $homeAddress = $dataRows['homeaddress'];
    ?>
        <table>
            <caption>Search Result</caption>
            <tr>
            <th>Name</th>
            <th>ID</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Home Address</th>
            <th>Search Again</th>
            </tr>
            <tr>
                <td><?php echo htmlentities($employeeName, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($id, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($department, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($salary, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($homeAddress, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td> <a href="PhpView.php">Search Again</a></td>
            </tr>
        </table>
    <?php }
}
?>
<table width="1000" border="5" align="center">
<caption>View From Database</caption>
    <tr>
        <th>Name</th>
        <th>ID</th>
        <th>Department</th>
        <th>Salary</th>
        <th>Home Address</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <!--DISPLAY ALL DATABASE COLUMNS IN EMPLOYEE TABLE-->
    <?php
    //Step 1: Include the database DSN
    $ConnectingDB;
    //Step 2:Create the sql select statement
    $sql = "SELECT * FROM emp_record";
    //Step 3: Using the DSN variable as an object, call the query method and assign it to $stmt. Put the $sql statement in the query() parameter.
    $stmt = $ConnectingDB->query($sql);

    //Step 4: Creating a loop to enumerate the data.
    //In the conditional of the while loop, use $stmt as an object and call the fetch() method. Assign this to the variable called $dataRows.
    while ($dataRows = $stmt->fetch()){

    // Step 5: in block code of the loop, retrieve the values from the columns using their names in the database and assign to variables
        $employeeName = $dataRows['employeeName'];
        $id = $dataRows['id'];
        $department = $dataRows['department'];
        $salary = $dataRows['salary'];
        $homeAddress = $dataRows['homeaddress'];


    ?>
    <!--PRINT DATA-->
    <tr>
        <td><?php echo htmlentities($employeeName, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($id, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($department, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($salary, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($homeAddress, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
    <!--UPDATE/DELETE LINKS-->
        <td><a href="PhpUpdate.php?id=<?php echo htmlentities($id, ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">Update</a> </td>
        <td><a href="PhpDelete.php?id=<?php echo htmlentities($id, ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">Delete</a></td>
    </tr>
    <?php } ?>


</table>
<div>
<a href="PhpInsert.php">Add Employee Form</a>
</div>
</body>
</html>
<?php


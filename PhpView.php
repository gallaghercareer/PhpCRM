<?php
/*
Author: John Gallagher
Purpose: The application is a employee management system for a business owner. This page is used to view data from the employee database.
Date: 8/1/2019
*/
//comment
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
The h2 tag below Outputs the data from the PhpDelete or PhpUpdate page.
The "@" behind the $_GET['id'] means it cannot throw an error if there are no values found in the $_GET array.
-->
<h2 class="successInfo"> <?php echo htmlentities(@$_GET['ssn'], ENT_QUOTES | ENT_HTML5, 'UTF-8');; ?></h2>


<!--Employee Search Box Form Field-->
<div>
    <fieldset>
        <legend> Search Employee</legend>
    <form action="PhpView.php" method="GET">
        <input type="text" name="search" placeholder="Search by SSN or Name">
        <input type="submit" name = "searchSubmit" value="Submit Search">
    </form>
    </fieldset>
</div>

<?php

//The following php/html code validates if the search button has been submitted, and returns the employee row selected.
if(isset($_GET['searchSubmit'])){
    $ConnectingDB;
    $search = $_GET['search'];
    $sql = "SELECT * FROM emp_record WHERE employeeName=:searcH or ssn=:searcH";
    $stmt=$ConnectingDB->prepare($sql);
    $stmt->bindValue(':searcH', $search);
    $stmt->execute();

    while($dataRows = $stmt->fetch()){
        $employeeName = $dataRows['employeeName'];
        $ssn = $dataRows['ssn'];
        $department = $dataRows['department'];
        $salary = $dataRows['salary'];
        $homeAddress = $dataRows['homeaddress'];
    ?>
        <table>
            <caption>Search Result</caption>
            <tr>
            <th>Name</th>
            <th>SSN</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Home Address</th>
            <th>Search Again</th>
            </tr>
            <tr>
                <td><?php echo htmlentities($employeeName, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($ssn, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($department, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($salary, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td><?php echo htmlentities($homeAddress, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
                <td> <a href="PhpView.php">Search Again</a></td>
            </tr>
        </table>
    <?php }
}
?>

<!-- Display ALL employees in Database below the search box-->
<table width="1000" border="5" align="center">
<caption>View From Database</caption>
    <tr>
        <th>Name</th>
        <th>SSN</th>
        <th>Department</th>
        <th>Salary</th>
        <th>Home Address</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
    //Step 1: DSN
    $ConnectingDB;

    //Step 2:SQL select statement
    $sql = "SELECT * FROM emp_record";

    //Step 3: Using the DSN variable as an object, call the query method and assign it to $stmt. Put the $sql statement in the query() parameter.
    $stmt = $ConnectingDB->query($sql);

    //Step 4: Creating a fetch() while-loop to iterate through the rows.
    while ($dataRows = $stmt->fetch()){

        $employeeName = $dataRows['employeeName'];
        $ssn = $dataRows['ssn'];
        $department = $dataRows['department'];
        $salary = $dataRows['salary'];
        $homeAddress = $dataRows['homeaddress'];


    ?>
    <!--PRINT DATA-->
    <tr>
        <td><?php echo htmlentities($employeeName, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($ssn, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($department, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($salary, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
        <td><?php echo htmlentities($homeAddress, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
    <!--UPDATE/DELETE LINKS-->
        <td><a href="PhpUpdate.php?ssn=<?php echo htmlentities($ssn, ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">Update</a> </td>
        <td><a href="PhpDelete.php?ssn=<?php echo htmlentities($ssn, ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">Delete</a></td>
    </tr>
    <?php } ?>


</table>
<div>
<a href="index.php">Add Employee Form</a>
</div>
</body>
</html>
<?php


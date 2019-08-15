<?php
/*
Author: John Gallagher
Purpose: The application is a employee management system for a business owner. This page is used to insert data into a database using a form.
Date: 8/1/2019
*/

require_once('PhpCrudDSN.php');

if(isset($_POST['submit'])) {
    //Validate to ensure that employeeName and ssn are not empty
    if (!empty($_POST['employeeName']) && !empty($_POST['ssn'])) {

        $employeeName = $_POST['employeeName'];
        $ssn = $_POST['ssn'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        $homeAddress = $_POST['homeaddress'];

        //Here we are setting the PDO to report errors retrieved from the database drivers.
        $ConnectingDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;

        //Step 1: Create Insert SQL code with Prepared Statements
        $sql = "INSERT INTO emp_record(employeeName, ssn, department, salary, homeaddress)
        VALUES(:employeeName, :ssn, :department,:salary,:homeaddress)";

        //Step 2: Prepare() SQL statement
        $stmt = $ConnectingDB->prepare($sql);

        //Step 3: Bind the values
        $stmt->bindValue(':employeeName', $employeeName);
        $stmt->bindValue(':ssn', $ssn);
        $stmt->bindValue(':department', $department);
        $stmt->bindValue(':salary', $salary);
        $stmt->bindValue(':homeaddress', $homeAddress);

        //Step 4: Execute and complete
        $Execute = $stmt->execute();

        //Step 5: Validate SQL insert success
        if (!$Execute) {
            echo "\nPDO::errorInfo():\n";
            print_r($ConnectingDB->errorInfo());
        }
        else {
            Echo "Success";
        }
        //Validate message ensuring ID/SSN form inputs are not empty.
     } else {
            echo "<span class='failureInfo'> The ID and Name are minimum requirements to submit form </span>";
        }
    }

?>

<!-- The HTML code below shows a form that will be submitted for insert data into database-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Data Into <Database></Database></title>
    <link rel="stylesheet" href="CrudCss.css">
</head>
<body>
<div class="">
    <form class="" action="index.php" method="post">
        <fieldset>
            <span class="FieldInfo">Employee Name</span>
            <br>
            <input type="text" name="employeeName">
            <br>
            <br>
            <span class="FieldInfo">SSN</span>
            <br>
            <input type="text" name="ssn">
            <br>
            <br>
            <span class="FieldInfo">Department</span>
            <br>
            <input type="text" name="department">
            <br>
            <br>
            <span class="FieldInfo">Salary</span>
            <br>
            <input type="text" name="salary">
            <br>
            <br>
            <span class="FieldInfo">Home Address</span>
            <br>
            <textarea type="text" name="homeaddress" rows="8" cols="80"> </textarea>
            <br>
            <br>
            <input name="submit" type="submit" value="Submit Employee Record" >
        </fieldset>
    </form>
</div>
<div><a href="PhpView.php" >View Employee Table</a>
</div>
</body>
</html>
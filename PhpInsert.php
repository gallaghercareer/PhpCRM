<?php

require_once('PhpCrudDSN.php');
if(isset($_POST['submit'])){
    if(!empty($_POST['employeeName']) && !empty($_POST['id'])) {
        $employeeName = $_POST['employeeName'];
        $id = $_POST['id'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        $homeAddress = $_POST['homeaddress'];

        //Use the DSN in this file that was imported via require_once
        $ConnectingDB;

        //Insert Data into Database

        //Step 1: Create Insert Statement with Prepared ":column" in the value
        $sql = "INSERT INTO emp_record(employeeName, id, department, salary, homeaddress)
        VALUES(:employeeName, :id, :department,:salary,:homeaddress)";

        //Step 2: Create a $stmt variable, assigning to it the DSN object using the method prepare() with the sql statement in it
        $stmt=$ConnectingDB->prepare($sql);

        //Step 3: Bind the values. The first parameter reflects the ":column" of the sql statment, the second represents the variable received from teh form
        $stmt->bindValue(':employeeName', $employeeName);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':department', $department);
        $stmt->bindValue(':salary', $salary);
        $stmt->bindValue(':homeaddress', $homeAddress);

        //Step 4: Execute and complete
        $execute=$stmt->execute();
        if($execute) {
            echo "<span class='successInfo'> Success </span>";
        }
        else {
            echo "<span class='failureInfo'> Insert not successful </span>";
        }

    }
    else {
        echo "<span class='failureInfo'> The ID and Name are minimum requirements to submit form </span>";
    }
}

?>
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
    <form class="" action="PhpInsert.php" method="post">
        <fieldset>
            <span class="FieldInfo">Employee Name</span>
            <br>
            <input type="text" name="employeeName">
            <br>
            <br>
            <span class="FieldInfo">Employee ID</span>
            <br>
            <input type="number" name="id">
            <br>
            <br>
            <span class="FieldInfo">Department</span>
            <br>
            <input type="text" name="department">
            <br>
            <br>
            <span class="FieldInfo">Salary</span>
            <br>
            <input type="number" name="salary" step="0.01">
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
<?php

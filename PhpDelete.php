<?php
/*
Author: John Gallagher
Purpose: The application is a employee management system for a business owner. This page is used to delete data from the employee database.
Date: 8/1/2019
*/
require_once('PhpCrudDSN.php');

//GET array value from PhpView.php
$searchQueryParameter= $_GET['ssn'];

//Delete selected row once form submit button is clicked.
if(isset($_POST['submit'])){
        $employeeName = $_POST['employeeName'];
        $ssn = $_POST['ssn'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        $homeAddress = $_POST['homeaddress'];

        //DSN
        $ConnectingDB;

        //Step 1: Create SQL Delete Statement
        $sql = "DELETE FROM emp_record WHERE ssn='$searchQueryParameter'";

        //Step 2: Query() SQL Statement
        $execute=$ConnectingDB->query($sql);

        //Step 3: Validate query() was successful in a new window.
        if($execute) {
            echo "<script>window.open('PhpView.php?ssn=Record Deleted Successfully', '_self')</script>";
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

<?php
//The PHP/HTML code below populates the form with row data. The data is from the row selected for deletion.

$sql="SELECT * FROM emp_record WHERE ssn='$searchQueryParameter'";
$stmt=$ConnectingDB->query($sql);

while($dataRows = $stmt->fetch()) {
    $employeeName = $dataRows['employeeName'];
    $ssn = $dataRows['ssn'];
    $department = $dataRows['department'];
    $salary = $dataRows['salary'];
    $homeAddress = $dataRows['homeaddress'];
}
?>

<div class="">
    <form class="" action="PhpDelete.php?ssn=<?php echo $searchQueryParameter;?>" method="post">
        <fieldset>
            <span class="FieldInfo">Employee Name</span>
            <br>
            <input type="text" name="employeeName" value="<?php echo htmlentities($employeeName, ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">
            <br>
            <br>
            <span class="FieldInfo">Employee SSN</span>
            <br>
            <input type="number" name="ssn" value="<?php echo htmlentities($ssn, ENT_QUOTES | ENT_HTML5, 'UTF-8');  ?>">
            <br>
            <br>
            <span class="FieldInfo">Department</span>
            <br>
            <input type="text" name="department" value="<?php echo htmlentities($department, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>">
            <br>
            <br>
            <span class="FieldInfo">Salary</span>
            <br>
            <input type="number" name="salary" step="0.01" value="<?php echo htmlentities($salary, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>">
            <br>
            <br>
            <span class="FieldInfo">Home Address</span>
            <br>
            <textarea type="text" name="homeaddress" rows="8" cols="80"><?php echo htmlentities($homeAddress, ENT_QUOTES | ENT_HTML5, 'UTF-8');  ?></textarea>
            <br>
            <br>
            <input name="submit" type="submit" value="Delete Employee Record" >
        </fieldset>
    </form>
</div>
</div>
<br>
<div>
    <a href="PhpView.php" >View Employee Table</a>
</div>
</body>
</html>
<?php

<?php
require_once('PhpCrudDSN.php');

//Search Parameter from the View Table
$searchQueryParameter= $_GET['id'];

if(isset($_POST['submit'])){
        //No need to validate for username or id in the UPDATE page bc we have to have an already existing id/name
        $employeeName = $_POST['employeeName'];
        $id = $_POST['id'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        $homeAddress = $_POST['homeaddress'];

        //Use the DSN in this file that was imported via require_once
        $ConnectingDB;

        //Update Data into Database

        //Step 1: Create Delete Statement
        $sql = "DELETE FROM emp_record WHERE id='$searchQueryParameter'";

        //Step 2: Create a $stmt variable, assigning to it the DSN object using the method prepare() with the sql statement in it
        $execute=$ConnectingDB->query($sql);

        if($execute) {
            echo "<script>window.open('PhpView.php?id=Record Deleted Successfully', '_self')</script>";
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
$ConnectingDB;
$sql="SELECT * FROM emp_record WHERE id='$searchQueryParameter'";
$stmt=$ConnectingDB->query($sql);

while($dataRows = $stmt->fetch()) {
    $employeeName = $dataRows['employeeName'];
    $id = $dataRows['id'];
    $department = $dataRows['department'];
    $salary = $dataRows['salary'];
    $homeAddress = $dataRows['homeaddress'];
}
?>

<div class="">
    <form class="" action="PhpDelete.php?id=<?php echo $searchQueryParameter;?>" method="post">
        <fieldset>
            <span class="FieldInfo">Employee Name</span>
            <br>
            <input type="text" name="employeeName" value="<?php echo htmlentities($employeeName, ENT_QUOTES | ENT_HTML5, 'UTF-8');?>">
            <br>
            <br>
            <span class="FieldInfo">Employee ID</span>
            <br>
            <input type="number" name="id" value="<?php echo htmlentities($id, ENT_QUOTES | ENT_HTML5, 'UTF-8');  ?>">
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

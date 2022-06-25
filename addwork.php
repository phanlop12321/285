<?php

session_start();

if (!$_SESSION["UserID"]) {  //check session

  Header("Location: formlogin.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
include("connection.php");


$Name = $_POST['Name'];
$type_budget = $_POST['type_budget'];
$year = $_POST['year'];
$diagram = $_POST['diagram'];
$estimate = $_POST['estimate'];
$estimate_date = $_POST['estimate_date'];
$construct = $_POST['construct'];
$construct_date = $_POST['construct_date'];
$Address = $_POST['Address'];



$User = $_SESSION["User"];
$id = $_SESSION["ID"];

/*echo $Name;
echo $type_budget;
echo $year;
echo $diagram;
echo $estimate;
echo $estimate_date;
echo $construct;
echo $construct_date;
echo $User;*/


$sql = "SELECT * FROM data285 WHERE id = $id AND ( user = '$User' ) ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    echo "Test update";
    echo $User;
    echo $id;

    $sql = "UPDATE data285 SET id='$id',Name='$Name',Type_Budget='$type_budget', year='$year', Diagram='$diagram', Estimate='$estimate', Estimate_Date='$estimate_date', Construct='$construct', Construct_Date='$construct_date', Address='$Address'  WHERE id = $id AND ( user = '$User' )";
   
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
header('Location: http://localhost/285/index285.php#WBS');



}else{

$sql = "INSERT INTO data285 (id,Name, Type_Budget, year, Diagram, Estimate, Estimate_Date, Construct, Construct_Date,Address,user )
VALUES ('$id','$Name', '$type_budget', '$year','$diagram', '$estimate','$estimate_date', '$construct','$construct_date','$Address','$User')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
header('Location: http://localhost/285/index285.php#WBS');

}

mysqli_close($conn);
}
?>
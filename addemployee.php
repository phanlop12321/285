<?php

session_start();

if (!$_SESSION["UserID"]) {  //check session

  Header("Location: formlogin.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
include("connection.php");

$ID_EMPLOYEE = $_POST['ID_EMPLOYEE'];
$FNAME = $_POST['FNAME'];
$LNAME = $_POST['LNAME'];
$RANK = $_POST['RANK'];
$DEPARTMENT = $_POST['DEPARTMENT'];
$FULLNAME = $_POST['FULLNAME'];
$pea = $_POST['pea'];
$county = $_POST['county'];
$TEL = $_POST['TEL'];
$User = $_SESSION["User"];
$id = $_SESSION["ID"];

echo $id ;
echo $User;
echo $ID_EMPLOYEE;
echo $FNAME;
echo $LNAME;
echo $RANK;
echo $DEPARTMENT;
echo $FULLNAME;
echo $TEL;

$sql1 = "SELECT * FROM employee WHERE ID = $ID_EMPLOYEE";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    $sql = "UPDATE data285 SET Employee ='$ID_EMPLOYEE' WHERE id = $id AND ( user = '$User' )";
   
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    
    
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}else{
    $sql = "INSERT INTO employee (ID, Fname, Lname, Rank, Under, Department, pea,county,phone )
    VALUES ('$ID_EMPLOYEE', '$FNAME', '$LNAME','$RANK', '$DEPARTMENT','$FULLNAME','$pea','$county', '$TEL')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "UPDATE data285 SET Employee ='$ID_EMPLOYEE' WHERE id = $id AND ( user = '$User' )";
   
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    
    
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
    header('Location: http://localhost/285/index285.php#vender');




mysqli_close($conn);
}
?>
<?php

session_start();

if (!$_SESSION["UserID"]) {  //check session

  Header("Location: formlogin.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
include("connection.php");

$wbs = $_POST['wbs'];
$network = $_POST['network'];
$activity = $_POST['activity'];


$User = $_SESSION["User"];
$id = $_SESSION["ID"];

//echo $network;


    $sql = "INSERT INTO wbs (WBS, NETWORK, ACT, id, user )
    VALUES ('$wbs', '$network', '$activity','$id', '$User')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header('Location: http://localhost/285/index285.php#vender');




mysqli_close($conn);
}
?>
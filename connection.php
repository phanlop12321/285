<?php
$conn= mysqli_connect("localhost","root","","peadb") or die("Error: " . mysqli_error($conn));
mysqli_query($conn, "SET NAMES 'utf8' "); 
?>
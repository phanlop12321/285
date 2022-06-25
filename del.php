
<?php
include('connection.php');
    $id = $_GET["id"];
    $price = $_GET["price"];
    
    $sql = "DELETE FROM end_data WHERE id = $id AND price = $price ";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}
header('Location: index285.php#work');
$conn->close();
    ?>
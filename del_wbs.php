
<?php
include('connection.php');
$wbs = $_GET["wbs"];
$id = $_GET["id"];


$sql2 = "SELECT * FROM wbs WHERE WBS='$wbs'";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {

  $NETWORK = $row2["NETWORK"];

  $sql = "DELETE FROM end_data WHERE ID_User = $id AND network = '$NETWORK' ";


  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully 444";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

$sql1 = "DELETE FROM wbs WHERE WBS='$wbs'";

if ($conn->query($sql1) === TRUE) {
  echo "Record deleted successfully 5555";
} else {
  echo "Error deleting record: " . $conn->error;
}
header('Location: index285.php#work');
$conn->close();
?>
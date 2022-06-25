<?php

session_start();

if (!$_SESSION["UserID"]) {  //check session

    Header("Location: formlogin.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
    include("connection.php");

    $FNAME_VENDER = $_POST['FNAME_VENDER'];
    $LNAME_VENDER = $_POST['LNAME_VENDER'];
    $IDTAX = $_POST['IDTAX'];
    $VENDER_LIST = $_POST['VENDER_LIST'];
    $SME = $_POST['SME'];
    $DATE = $_POST['DATE'];
    $ADDRESS = $_POST['ADDRESS'];
    $TEL = $_POST['TEL'];

    $PERCENT = $_POST['PERCENT'];

    $material = $_POST['material'];
    $GL = $_POST['GL'];
    $loan = $_POST['loan'];
    $loan_number = $_POST['loan_number'];

    $avouch = $_POST['avouch'];

    $User = $_SESSION["User"];
    $id = $_SESSION["ID"];

    

    


echo"----------";

    echo $FNAME_VENDER;
    echo $LNAME_VENDER;
    echo $VENDER_LIST;
    echo $SME;
    echo $DATE;
    echo $ADDRESS;
    echo $TEL;


    $sql1 = "SELECT * FROM vender WHERE vdlist = '$VENDER_LIST'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $sql = "UPDATE data285 SET Vender_List ='$VENDER_LIST' ,PERCENT ='$PERCENT',material ='$material',GL ='$GL',loan ='$loan',loan_number ='$loan_number',avouch ='$avouch' WHERE id = $id AND ( user = '$User' )";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $sql = "INSERT INTO vender (fname, lname, address, sme, vdlist, idtax, smedate, tel )
VALUES ('$FNAME_VENDER', '$LNAME_VENDER', '$ADDRESS','$SME','$VENDER_LIST','$IDTAX', '$DATE',  '$TEL')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sql = "UPDATE data285 SET Vender_List ='$VENDER_LIST' ,PERCENT ='$PERCENT',material ='$material',GL ='$GL',loan ='$loan',loan_number ='$loan_number',avouch ='$avouch' WHERE id = $id AND ( user = '$User' )";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    //header('Location: http://localhost/285/index285.php#vender');





    mysqli_close($conn);
}

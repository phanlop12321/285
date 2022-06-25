<?php
session_start();

if (!$_SESSION["UserID"]) {  

  Header("Location: formlogin.php"); 

} else {
include('connection.php');

$user = $_SESSION["User"];

$sql1 = "SELECT * FROM data285 WHERE user = '$user' ORDER BY id DESC";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
  $id = $result1->fetch_assoc();

  //echo $id["id"]; 
  $id = $id["id"]+1;
}else{
  $id = 1;
}


$sql = "SELECT * FROM data285 WHERE user = '$user' ";
$result = $conn->query($sql);



?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <style>
    .center1 {
      margin: auto;
      width: 50%;
      text-align: center;
    }

    label {
      margin: 10px;
      font-weight: bold;
    }

    #form1 {
      background-image: url("img/form1.png");
    }

    #form2 {
      background-image: url("img/form2.png");
    }

    #form3 {
      background-image: url("img/form3.png");
    }

    #form4 {
      background-image: url("img/form4.png");
    }

    #form5 {
      background-image: url("img/form5.png");
    }
  </style>
</head>

<body style="background-color: #F5F5F5;">
  <nav class="navbar fixed-top navbar-expand-lg " style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LOGO</a>
    </div>
  </nav>
  <div class="container" id="margin">
    <br><br>

    <div class="container">
      <form class="shadow p-3 mb-5 bg-body rounded" id="form1" action="index285.php" method="post">
        <div class="form-group col">
          <div class="center1">
            <h1>โปรแกรมจ้างเหมาก่อสร้างระบบไฟฟ้า</h1>
            <h4>Power System Procurement and Construction Program</h4>
          </div>
          <br>
          <input type="hidden" id="custId" name="create" value="<?php echo $id; ?>">
          <button type="submit" class="btn btn-outline-success">สร้างเอกสาร</button>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ชื่องาน</th>
                <th scope="col">รายงานขอจ้าง</th>
                <th scope="col">ขออนุมัติกำหนดราคากลาง</th>
                <th scope="col">รายงานผลการพิจารณาและขออนุมัติสั่งจ้าง</th>
                <th scope="col">ใบขอเสนอซื้อ/จ้าง</th>
                <th scope="col">ขออนุมัติวางเงินประกัน</th>
                <th scope="col">สัญญาจ้างเหมา</th>
                <th scope="col">แจ้งให้เข้าเริ่มดำเนินการ</th>
              </tr>
            </thead>
            <tbody>
              
                <?php
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {?>
                  <tr>
                  <td><a href="index285.php?create=<?= $row["id"]; ?>" class="alert-link"><?= $row["Name"]; ?></a></td>
                  <td><a href="pdfA.php?create=<?= $row["id"]; ?>" target="_blank" class="alert-link"><i class="bi bi-filetype-pdf" style='font-size:50px; color: #9900FF;' ></i></a></td>
                  <td><a href="pdfC.php?create=<?= $row["id"]; ?>" target="_blank" class="alert-link"><i class="bi bi-filetype-pdf" style='font-size:50px; color: #9900FF;'></i></a></td>
                  <td><a href="pdfE.php?create=<?= $row["id"]; ?>" target="_blank" class="alert-link"><i class="bi bi-filetype-pdf" style='font-size:50px; color: #9900FF;'></i></a></td>
                  <td><a href="pdfF.php?create=<?= $row["id"]; ?>" target="_blank" class="alert-link"><i class="bi bi-filetype-pdf" style='font-size:50px; color: #9900FF;'></i></a></td>
                  <td><a href="pdfG.php?create=<?= $row["id"]; ?>" target="_blank" class="alert-link"><i class="bi bi-filetype-pdf" style='font-size:50px; color: #9900FF;'></i></a></td>
                  <td><a href="pdfA.php?create=<?= $row["id"]; ?>" target="_blank" class="alert-link"><i class="bi bi-filetype-pdf" style='font-size:50px; color: #9900FF;'></i></a></td>
                  <td><a href="pdfI.php?create=<?= $row["id"]; ?>" target="_blank" class="alert-link"><i class="bi bi-filetype-pdf" style='font-size:50px; color: #9900FF;'></i></a></td>
                  </tr>
                    <?php
                  }
                }
                ?>
              
            </tbody>
          </table>
        </div>

      </form>
      <br>
    </div>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="assets/jquery.min.js"></script>
  <script src="assets/script.js"></script>
</body>

</html>
<?php } ?>

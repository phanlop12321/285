<?php

session_start();

if (!$_SESSION["UserID"]) {  //check session

  Header("Location: formlogin.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
  include('connection.php');

  function Convert($amount_number)
  {
    $amount_number = number_format($amount_number, 2, ".", "");
    $pt = strpos($amount_number, ".");
    $number = $fraction = "";
    if ($pt === false)
      $number = $amount_number;
    else {
      $number = substr($amount_number, 0, $pt);
      $fraction = substr($amount_number, $pt + 1);
    }

    $ret = "";
    $baht = ReadNumber($number);
    if ($baht != "")
      $ret .= $baht . "บาท";

    $satang = ReadNumber($fraction);
    if ($satang != "")
      $ret .=  $satang . "สตางค์";
    else
      $ret .= "ถ้วน";
    return $ret;
  }

  $i = 1;
  $price = 0;
  $vat = 0;
  $price_abd_vat = 0;
  if (isset($_POST['create'])) {
    $_SESSION["ID"] = $_POST['create'];
  }

  if (isset($_GET['create'])) {
    $_SESSION["ID"] = $_GET['create'];
  }

  $user = $_SESSION["User"];
  $id = $_SESSION["ID"];




  $sql3 = "SELECT * FROM data285 WHERE  id = $id AND ( user = '$user' )";
  $result3 = $conn->query($sql3);

  $row3 = $result3->fetch_assoc();

  if (is_array($row3)) {
    $ID_employee = $row3["Employee"];
    $ID_vdlist = $row3["Vender_List"];

    $sql1 = "SELECT * FROM employee WHERE ID=$ID_employee";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();

    $sql2 = "SELECT * FROM vender WHERE vdlist=$ID_vdlist";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
  }


?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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

      /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      /* Firefox */
      input[type=number] {
        -moz-appearance: textfield;
      }
    </style>
  </head>

  <body style="background-color: #F5F5F5;">
    <nav class="navbar fixed-top navbar-expand-lg " style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
    <div class="container" id="margin">
      <br><br>


      <div class="container">
        <form class="shadow p-3 mb-5 bg-body rounded" id="form1" action="addwork.php" method="post">
          <div class="form-group col">
            <div class="center1">
              <h1>ข้อมูลแฟ้มงาน</h1>
            </div>

            <br>
            <label>ชื่องาน</label>
            <input type="text" class="form-control" id="ID" name="Name" placeholder="" value="<?php if (isset($row3["Name"])) {
                                                                                                echo $row3["Name"];
                                                                                              } ?>" required>
          </div>
          <div class="row">
            <div class="form-group col-md-3">
              <label>ประเภทงาน</label>
              <select class="form-control" id="exampleFormControlSelect1" name="type_budget">
                <option>งบผู้ใช้ไฟ</option>
                <option>งบโครงการ</option>
                <option>งบลงทุน</option>
                <?php if (isset($row3["Type_Budget"])) { ?>
                  <option selected><?= $row3["Type_Budget"]; ?></option><?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label>ปี พ.ศ.</label>
              <input type="text" class="form-control" name="year" value="<?php if (isset($row3["year"])) {
                                                                            echo $row3["year"];
                                                                          } ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-3">
              <label>แบบแผนผังก่อสร้าง</label>
              <input type="text" class="form-control" name="diagram" placeholder="กรุณาใส่แบบแผนผังก่อสร้าง" value="<?php if (isset($row3["Diagram"])) {
                                                                                                                      echo $row3["Diagram"];
                                                                                                                    } ?>" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-3">
              <label>อนุมัติประมาณการเลขที่</label>
              <input type="text" class="form-control" name="estimate" placeholder="กรุณาใส่ อนุมัติประมาณการเลขที่" value="<?php if (isset($row3["Estimate"])) {
                                                                                                                              echo $row3["Estimate"];
                                                                                                                            } ?>" required>
            </div>
            <div class="form-group col-md-3">
              <label>ลว.</label>
              <input type="date" class="form-control" name="estimate_date" placeholder="วัน เดือน ปี " value="<?php if (isset($row3["Estimate_Date"])) {
                                                                                                                echo $row3["Estimate_Date"];
                                                                                                              } ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-3">
              <label>อนุมัติงานก่อสร้าง</label>
              <input type="text" class="form-control" name="construct" placeholder="กรุณาใส่ อนุมัติงานก่อสร้าง" value="<?php if (isset($row3["Construct"])) {
                                                                                                                          echo $row3["Construct"];
                                                                                                                        } ?>" required>
            </div>
            <div class="form-group col-md-3">
              <label>ลว.</label>
              <input type="date" class="form-control" name="construct_date" placeholder="วัน เดือน ปี " value="<?php if (isset($row3["Construct_Date"])) {
                                                                                                                  echo $row3["Construct_Date"];
                                                                                                                } ?>" required>

            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label>ดำเนินการก่อสร้างบริเวณ</label>
              <input type="text" class="form-control" name="Address" placeholder="" value="<?php if (isset($row3["Address"])) {
                                                                                              echo $row3["Address"];
                                                                                            } ?>" required>
            </div>
          </div>
          <br>
          <?php
          ?>
          <div class="center1">
            <button type="submit" class="btn btn-outline-primary"> บันทึก </button>
          </div>
        </form>
        <br>
      </div>
      <?php
      if (is_array($row3)) {

        $sql4 = "SELECT * FROM wbs WHERE  id = $id AND ( user = '$user' )";
        $result4 = $conn->query($sql4);
        $result5 = $conn->query($sql4);
        $result6 = $conn->query($sql4);
        $row5 = $result5->fetch_assoc();




      ?>

        <div class="container" id="WBS">
          <form class="shadow p-3 mb-5 bg-body rounded" action="addwbs.php" method="POST">
            <div class="form-group col">
              <div class="row">
                <div class="form-group col-md-4">
                  <label>WBS</label>
                  <?php if (is_array($row5)) { ?>
                    <input type="text" class="form-control" value="<?= $row5["WBS"]; ?>" disabled>
                    <input type="hidden" name="wbs" value="<?= $row5["WBS"]; ?>">
                  <?php } else { ?>

                    <input type="text" class="form-control" name="wbs" placeholder="กรุณาใส่ WBS" required>
                  <?php } ?>
                </div>
                <div class="form-group col-md-4">
                  <label>รหัสเครือข่าย</label>
                  <input type="text" class="form-control" name="network" placeholder="กรุณาใส่ รหัสเครือข่าย" required>
                </div>
                <div class="form-group col-md-2">
                  <label>กิจกรรม</label>
                  <input type="text" class="form-control" name="activity" placeholder="กรุณาใส่ กิจกรรม" required>
                </div>
                <div class="form-group col-md-2">
                  <br>
                  <button type="submit" class="btn btn-outline-primary" style="margin: 20px;">เพิ่ม</button>
                </div>
                <?php if (is_array($row5)) { ?>
                  <div class="form-group col-md-2">
                    <a href="del_wbs.php?wbs=<?= $row5["WBS"]; ?>&NETWORK=<?= $row5["NETWORK"]; ?>&id=<?= $row5['id']; ?>" style="color: red; " onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ WBS</a>
                  </div>
                <?php } ?>

              </div>
            </div>
        </div>
        </form>
    </div>




    <div class="container" id="work">
      <?php if (is_array($row5)) { ?>
        <form class="shadow p-3 mb-5 bg-body rounded" method="GET" action="check.php">
          <div class="form-group col">
            <div class="row">
              <div class="form-group col-md-3">
                <label>WBS</label>
                <input type="text" class="form-control" value="<?= $row5["WBS"]; ?>" disabled>
              </div>

              <div class="form-group col-md-3">
                <label>โครงข่าย</label>
                <select class="form-select" aria-label="Default select example" name="NETWORK">
                  <?php while ($row6 = $result6->fetch_assoc()) {  ?>
                    <option><?= $row6["NETWORK"]; ?></option>
                  <?php } ?>
                </select>
              </div>


            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label>ราคากลาง</label>
                <input type="number" class="form-control" name="CODE" id="ID_CODE" required>
              </div>
              <div class="form-group col-md-3">
                <label>เลือกสภาพภูมิประเทศ</label>
                <select class="form-select" aria-label="Default select example" name="case" id="case_ID">
                  <option selected>เลือกสภาพภูมิประเทศ</option>
                </select>
              </div>
              <div class="form-group col-md-1">
                <label>จำนวน</label>
                <input type="text" class="form-control" name="quantity" placeholder=" " required>
              </div>
              <div class="form-group col-md-3">
                <label>ติดตั้ง/รื้อถอน/นำกลับมาใช้ใหม่</label>
                <select class="form-select" aria-label="Default select example" name="job" id="job_ID">
                  <option selected>แผนกติดตั้ง</option>
                  <option>แผนกรื้อถอน</option>
                  <option>นำกลับมาใช้ใหม่</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <br>
                <button type="submit" class="btn btn-outline-primary" style="margin: 20px;">เพิ่ม</button>
              </div>
            </div>
          </div>
        </form>

      <?php } ?>
      <?php
        while ($row4 = $result4->fetch_assoc()) {



          if (is_array($row4)) {



            $NETWORK = $row4["NETWORK"];



            $sql = "SELECT * FROM end_data WHERE network =  $NETWORK  ";
            $result = $conn->query($sql);
      ?>

          <div>


            <table class="table table-striped">
              <div class="row">
                <div class="form-group col-md-3">
                  <input type="text" class="form-control" value="โครงข่าย <?= $row4["NETWORK"]; ?>" disabled>
                </div>
                <div class="form-group col-md-3">
                  <button class="btn btn-outline-danger"><a href="del_network.php?id=<?= $row4['id']; ?>&NETWORK=<?= $row4["NETWORK"]; ?>" style="color: red; " onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></button>
                </div>
              </div>
              <tr>
                <th>ที่</th>
                <th>แผนก</th>
                <th>รายละเอียด</th>
                <th>จำนวน</th>
                <th>ราคากลางต่อหน่วย</th>
                <th>ราคาไม่รวมภาษีฯ</th>
                <th>ภาษีฯ 7 %</th>
                <th>ราคารวมภาษีฯ</th>
                <th>ลบ</th>
              </tr>
              <?php


              // output data of each row
              while ($row = $result->fetch_assoc()) {

              ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $row["job"]; ?></td>
                  <td><?= $row["name"]; ?></td>
                  <td><?= $row["quantity"]; ?></td>
                  <td><?= "";
                      echo number_format($row["price"]); ?></td>
                  <td><?= "";
                      echo number_format($row["price_no_v"]); ?></td>
                  <td><?= "";
                      echo number_format($row["vat"]); ?></td>
                  <td><?= "";
                      echo number_format($row["price_and_v"]); ?></td>

                  <td><a href="del.php?id=<?= $row['id']; ?>&price=<?= $row['price']; ?>" style="color: red; " onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                </tr>
              <?php
                $i = $i + 1;
                $price = $price + $row["price_no_v"];
                $vat = $vat + $row["vat"];
                $price_abd_vat = $price_abd_vat + $row["price_and_v"];
              }


              ?>
              <tr>
                <td></td>
                <td></td>
                <td>ราคารวม (บาท)</td>
                <td></td>
                <td></td>
                <td>
                  <?= "";
                  echo number_format($price);
                  $price = 0; ?>

                </td>
                <td>

                  <?= "";
                  echo number_format($vat);
                  $vat = 0; ?>
                </td>
                <td>

                  <?= "";
                  echo number_format($price_abd_vat);
                  $price_abd_vat = 0;
                  $i = 1; ?>
                </td>
                <td></td>
              </tr>

            </table>
          </div>
      <?php
          }
        } ?>
    </div>



    <div class="container" id="user">
      <div class="center1">
      </div>
      <form class="shadow p-3 mb-5 bg-body rounded" id="form2" action="addemployee.php" method="POST">
        <div class="center1">
          <h1>ข้อมูลพนักงาน</h1>
        </div>
        <br>
        <div class="form-group col-md-2 ">
          <label>รหัสพนักงาน</label>
          <input type="number" onkeyup="serchEmployee('ID_EMPLOYEE')" class="form-control" name="ID_EMPLOYEE" placeholder="กรุณาใส่รหัสพนักงาน" value="<?php if (isset($row1["ID"])) {
                                                                                                                                                          echo $row1["ID"];
                                                                                                                                                        } ?>" required>
          <span id="search_result_id" class="search_result">

          </span>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>ชื่อจริง</label>
            <input type="text" onkeyup="serchEmployee('FNAME')" class="form-control" name="FNAME" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row1["Fname"])) {
                                                                                                                                          echo $row1["Fname"];
                                                                                                                                        } ?>" required>
            <span id="search_result_fname" class="search_result">
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LNAME" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row1["Lname"])) {
                                                                                                        echo $row1["Lname"];
                                                                                                      } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="RANK" placeholder="กรุณาใส่ตำแหน่ง" value="<?php if (isset($row1["Rank"])) {
                                                                                                        echo $row1["Rank"];
                                                                                                      } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ชื่อย่อ แผนก</label>
            <input type="text" class="form-control" name="DEPARTMENT" placeholder="กรุณาใส่สังกัด" value="<?php if (isset($row1["Under"])) {
                                                                                                            echo $row1["Under"];
                                                                                                          } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label>ชื่อเต็มแผนก</label>
            <input type="text" class="form-control" name="FULLNAME" placeholder="กรุณาใส่ชื่อเต็มแผนก ex. แผนกก่อสร้าง" value="<?php if (isset($row1["Department"])) {
                                                                                                                                  echo $row1["Department"];
                                                                                                                                } ?>" required>
          </div>
          <div class="form-group col-md-2">
            <label>ชื่อย่อ กฟฟ</label>
            <input type="text" class="form-control" name="pea" placeholder="ex. กฟจ.อต." value="<?php if (isset($row1["pea"])) {
                                                                                                  echo $row1["pea"];
                                                                                                } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>เขต</label>
            <select class="form-select" aria-label="Default select example" name="county" id="county">
              <option>น.1</option>
              <option selected>น.2</option>
              <option>น.3</option>
              <?php if (isset($row1["county"])) { ?>
                <option selected><?= $row1["county"]; ?></option><?php } ?>

            </select>
          </div>
          <div class="form-group col-md-3">
            <label>เบอร์โทรแผนก</label>
            <input type="text" class="form-control" name="TEL" placeholder="กรุณาใส่เบอร์โทรแผนก" value="<?php if (isset($row1["phone"])) {
                                                                                                            echo $row1["phone"];
                                                                                                          } ?>" required>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-outline-primary"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>
    <script>
      let dataEmployees = [];
      const headers = {
        'Content-type': 'application/json; charset=UTF-8'
      };

      function serchEmployee(type) {
        switch (type) {
          case "ID_EMPLOYEE":
            //request  -> find employee form id
            const employeeId = document.getElementsByName('ID_EMPLOYEE')[0].value;
            if (employeeId.length >= 4) {
              fetchEmployeById(employeeId);
            }

            break;
          case "FNAME":
            const fName = document.getElementsByName('FNAME')[0].value;
            if (fName.length >= 4) {
              fetchEmployeByFName(fName);
            }
            break;
          default:
            console.log("default");
            break;
        }
      }
      const fetchEmployeByFName = (fName) => {

        fetch("service/employee.php", { //ส่ง id เพื่อไป getdata employee
          method: "POST",
          body: JSON.stringify({ //encode json
            fName: fName
          }),
          headers
        }).then(function(response) {

          return response.json();

        }).then(function(responseData) {
          console.log({
            responseData
          });
          const html = autocomplete(responseData);
          if (html != null) {
            document.getElementById('search_result_fname').innerHTML = html;
          }
        });
      };
      const fetchEmployeById = (id) => {
        console.log({
          id
        });
        fetch("service/employee.php", { //ส่ง id เพื่อไป getdata employee
          method: "POST",
          body: JSON.stringify({ //encode json
            id
          }),
          headers
        }).then(function(response) {

          return response.json();

        }).then(function(responseData) {
          console.log({
            responseData
          });

          const html = autocomplete(responseData);
          if (html != null) {
            document.getElementById('search_result_id').innerHTML = html;
          }

        });
      };
      const autocomplete = (employees) => {
        let html = null;
        if (employees.length > 0) {
          dataEmployees = employees;

          html = '<ul class="list-group">';

          html += '<li class="list-group-item d-flex justify-content-between align-items-center"><b class="text-primary"><i>Your Recent Searches</i></b></li>';
          for (let count = 0; count < employees.length; count++) {

            html += '<li class="list-group-item text-muted" style="cursor:pointer"  onclick="selectEmployee(' + count + ')"><i class="fas fa-history mr-3"></i><span>' + employees[count].Fname + '</span> <i class="far fa-trash-alt float-right mt-1" ></i></li>';

          }
          html += '</ul>';
        }
        return html
      }

      function selectEmployee(key) {
        const employeeSelected = dataEmployees[key];

        document.getElementsByName('ID_EMPLOYEE')[0].value = employeeSelected.ID
        document.getElementsByName('FNAME')[0].value = employeeSelected.Fname
        document.getElementsByName('LNAME')[0].value = employeeSelected.Lname
        document.getElementsByName('RANK')[0].value = employeeSelected.Rank
        document.getElementsByName('DEPARTMENT')[0].value = employeeSelected.Under
        document.getElementsByName('FULLNAME')[0].value = employeeSelected.Department
        document.getElementsByName('pea')[0].value = employeeSelected.pea
        document.getElementsByName('county')[0].value = employeeSelected.county
        document.getElementsByName('TEL')[0].value = employeeSelected.phone

        const els = document.getElementsByClassName('search_result');
        // document.getElementById('search_result_id').innerHTML = '';
        Array.prototype.forEach.call(els, function(el) {
          el.innerHTML = '';
        });


      }
    </script>
    <div class="container" id="vender">
      <div class="col offset-md-5">
      </div>
      <form class="shadow p-3 mb-5 bg-body rounded" id="form3" action="addvender.php" method="POST">
        <div class="center1">
          <h1>ข้อมูลผู้รับจ้าง</h1>
        </div>
        <br>
        <div class="row">
          <div class="form-group col-md-3 offset-md-6">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FNAME_VENDER" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row2["fname"])) {
                                                                                                                echo $row2["fname"];
                                                                                                              } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LNAME_VENDER" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row2["lname"])) {
                                                                                                                echo $row2["lname"];
                                                                                                              } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 offset-md-6">
            <label>เลขประจำตัวผู้เสียภาษี</label>
            <input type="text" class="form-control" name="IDTAX" placeholder="กรุณาใส่ เลขประจำตัวผู้เสียภาษี" value="<?php if (isset($row2["idtax"])) {
                                                                                                                        echo $row2["idtax"];
                                                                                                                      } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>Vender List</label>
            <input type="text" class="form-control" name="VENDER_LIST" placeholder="กรุณาใส่ Vender List" value="<?php if (isset($row2["vdlist"])) {
                                                                                                                    echo $row2["vdlist"];
                                                                                                                  } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4 offset-md-6">
            <label>ทะเบียนสมาชิก SME</label>
            <input type="text" class="form-control" name="SME" placeholder="กรุณาใส่ชื่อ ทะเบียนสมาชิก SME" value="<?php if (isset($row2["sme"])) {
                                                                                                                      echo $row2["sme"];
                                                                                                                    } ?>" required>
          </div>
          <div class="form-group col-md-2">
            <label>ลว</label>
            <input type="date" class="form-control" name="DATE" value="<?php if (isset($row2["smedate"])) {
                                                                          echo $row2["smedate"];
                                                                        } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4 offset-md-6">
            <label>บ้านเลขที่</label>
            <input type="text" class="form-control" name="ADDRESS" placeholder="กรุณาใส่ บ้านเลขที่" value="<?php if (isset($row2["address"])) {
                                                                                                              echo $row2["address"];
                                                                                                            } ?>" required>
          </div>
          <div class="form-group col-md-2">
            <label>เบอร์โทรศัพท์</label>
            <input type="tel" class="form-control" name="TEL" placeholder=" " value="<?php if (isset($row2["tel"])) {
                                                                                        echo $row2["tel"];
                                                                                      } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-2 offset-md-6">
            <label>เปอร์เซ็นต์การจ้าง</label>
            <input type="number" class="form-control" name="PERCENT" placeholder="" value="<?php if (isset($row3["PERCENT"])) {
                                                                                              echo $row3["PERCENT"];
                                                                                            } ?>" required>
          </div>
          <div class="form-group col-md-2">
            <label>กลุ่มวัสดุ</label>
            <input type="text" class="form-control" name="material" placeholder=" " value="<?php if (isset($row3["material"])) {
                                                                                              echo $row3["material"];
                                                                                            } ?>" required>
          </div>
          <div class="form-group col-md-2">
            <label>รหัสบัญชี GL</label>
            <input type="number" class="form-control" name="GL" placeholder=" " value="<?php if (isset($row3["GL"])) {
                                                                                          echo $row3["GL"];
                                                                                        } ?>" required>
          </div>

        </div>
        <div class="row">
          <div class="form-group col-md-2 offset-md-6">
            <label>แหล่งเงินกู้</label>
            <input type="number" class="form-control" name="loan" placeholder="" value="<?php if (isset($row3["loan"])) {
                                                                                          echo $row3["loan"];
                                                                                        } ?>" required>
          </div>
          <div class="form-group col-md-2">
            <label>เลขที่สัญญากู้</label>
            <input type="number" class="form-control" name="loan_number" placeholder=" " value="<?php if (isset($row3["loan_number"])) {
                                                                                                  echo $row3["loan_number"];
                                                                                                } ?>" required>
          </div>
          <div class="form-group col-md-2">
            <label>รับประกันงาน(วัน)</label>
            <input type="number" class="form-control" name="avouch" placeholder=" " value="<?php if (isset($row3["avouch"])) {
                                                                                              echo $row3["avouch"];
                                                                                            } ?>" required>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-outline-primary"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>

    <div class="container" id="vender">
      <form class="shadow p-3 mb-5 bg-body rounded" id="form4" action="adddirector.php" method="POST">
        <div class="center1">
          <h1>แต่งตั้งคณะกรรมการราคากลาง</h1>
        </div>
        <br>
        <div class="row">
          <div class="form-group col-md-3 ">

            <label>บันทึกกำหนดราคากลาง</label>
            <input type="text" class="form-control" name="center_price" placeholder="กรุณาใส่ บันทึกกำหนดราคากลาง" value="<?php if (isset($row3["Center_price"])) {
                                                                                                                            echo $row3["Center_price"];
                                                                                                                          } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ลว</label>
            <input type="date" class="form-control" name="center_price_date" value="<?php if (isset($row3["Center_Price_Date"])) {
                                                                                      echo $row3["Center_Price_Date"];
                                                                                    } ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Chairman_Center_Price" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row3["FName_Chairman_Center_Price"])) {
                                                                                                                                echo $row3["FName_Chairman_Center_Price"];
                                                                                                                              } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="Lname_Chairman_Center_Price" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row3["Lname_Chairman_Center_Price"])) {
                                                                                                                              echo $row3["Lname_Chairman_Center_Price"];
                                                                                                                            } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_C_C" placeholder="กรุณาใส่ ตำแหน่ง" value="<?php if (isset($row3["Rank_C_C"])) {
                                                                                                            echo $row3["Rank_C_C"];
                                                                                                          } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>ประธานกรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_1" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row3["FName_Director_1"])) {
                                                                                                                    echo $row3["FName_Director_1"];
                                                                                                                  } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_1" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row3["LName_Director_1"])) {
                                                                                                                    echo $row3["LName_Director_1"];
                                                                                                                  } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_C1" placeholder="กรุณาใส่ ตำแหน่ง" value="<?php if (isset($row3["Rank_D_C1"])) {
                                                                                                              echo $row3["Rank_D_C1"];
                                                                                                            } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_2" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row3["FName_Director_2"])) {
                                                                                                                    echo $row3["FName_Director_2"];
                                                                                                                  } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_2" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row3["LName_Director_2"])) {
                                                                                                                    echo $row3["LName_Director_2"];
                                                                                                                  } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_C2" placeholder="กรุณาใส่ ตำแหน่ง" value="<?php if (isset($row3["Rank_D_C2"])) {
                                                                                                              echo $row3["Rank_D_C2"];
                                                                                                            } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-outline-primary"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>

    <div class="container" id="vender">
      <div class="center1">
      </div>
      <form class="shadow p-3 mb-5 bg-body rounded" id="form5" action="adddirectorcheck.php" method="POST">
        <div class="center1">
          <h1>แต่งตั้งคณะกรรมการตรวจรับพัสดุ/ผู้ตรวจรับพัสดุ</h1>
        </div>
        <br>
        <div class="row">
          <div class="form-group col-md-3 ">

            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Chairman_Check" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row3["FName_Chairman_Check"])) {
                                                                                                                        echo $row3["FName_Chairman_Check"];
                                                                                                                      } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Chairman_Check" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row3["LName_Chairman_Check"])) {
                                                                                                                        echo $row3["LName_Chairman_Check"];
                                                                                                                      } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_C_Check" placeholder="กรุณาใส่ ตำแหน่ง" value="<?php if (isset($row3["Rank_C_Check"])) {
                                                                                                                echo $row3["Rank_C_Check"];
                                                                                                              } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>ประธานกรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_Check1" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row3["FName_Director_Check1"])) {
                                                                                                                          echo $row3["FName_Director_Check1"];
                                                                                                                        } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_Check1" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row3["LName_Director_Check1"])) {
                                                                                                                        echo $row3["LName_Director_Check1"];
                                                                                                                      } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_Check1" placeholder="กรุณาใส่ ตำแหน่ง" value="<?php if (isset($row3["Rank_D_Check1"])) {
                                                                                                                  echo $row3["Rank_D_Check1"];
                                                                                                                } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_Check2" placeholder="กรุณาใส่ชื่อจริง" value="<?php if (isset($row3["FName_Director_Check2"])) {
                                                                                                                          echo $row3["FName_Director_Check2"];
                                                                                                                        } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_Check2" placeholder="กรุณาใส่นามสกุล" value="<?php if (isset($row3["LName_Director_Check2"])) {
                                                                                                                        echo $row3["LName_Director_Check2"];
                                                                                                                      } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_Check2" placeholder="กรุณาใส่ ตำแหน่ง" value="<?php if (isset($row3["Rank_D_Check2"])) {
                                                                                                                  echo $row3["Rank_D_Check2"];
                                                                                                                } ?>" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-outline-primary"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>

  <?php } ?>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="assets/jquery.min.js"></script>
  <script src="assets/script.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  </body>

  </html>

<?php } ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100&display=swap" rel="stylesheet">

  <title>285</title>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light btn-gradient-border btn-glow" style="background: rgb(0,0,0);">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LOGO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <div class="container" id="margin">

    <div class="container" id="work">
      <div class="center1">

      </div>
      <form  action="addwork.php" method="post">
        <div class="form-group col">
          <h1 class="text-gradient">ข้อมูลแฟ้มงาน</h1>
          <br>
          <label>ชื่องาน</label>
          <input type="text" class="form-control" id="ID" name="Name" placeholder=" " required>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label for="exampleFormControlSelect1">ประเภทงาน</label>
            <select class="form-control" id="exampleFormControlSelect1" name="type_budget">
              <option selected="selected">งบผู้ใช้ไฟ</option>
              <option>งบโครงการ</option>
              <option>งบลงทุน</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>ปี พ.ศ.</label>
            <input type="text" class="form-control" name="year" placeholder="" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>แบบแผนผังก่อสร้าง</label>
            <input type="text" class="form-control" name="diagram" placeholder="กรุณาใส่แบบแผนผังก่อสร้าง" required>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-3">
            <label>อนุมัติประมาณการเลขที่</label>
            <input type="text" class="form-control" name="estimate" placeholder="กรุณาใส่ อนุมัติประมาณการเลขที่" required>
          </div>
          <div class="form-group col-md-3">
            <label>ลว.</label>
            <input type="date" class="form-control" name="estimate_date" placeholder="วัน เดือน ปี " required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>อนุมัติงานก่อสร้าง</label>
            <input type="text" class="form-control" name="construct" placeholder="กรุณาใส่ อนุมัติงานก่อสร้าง" required>
          </div>
          <div class="form-group col-md-3">
            <label>ลว.</label>
            <input type="date" class="form-control" name="construct_date" placeholder="วัน เดือน ปี " required>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-gradient-border btn-glow"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>
    <br><br><br>
    <form class="btn-gradient-border ">
      <div class="form-group col">
        <div class="row">
          <div class="form-group col-md-3">
            <label>WBS</label>
            <input type="text" class="form-control" name="wbs" placeholder="กรุณาใส่ WBS" required>
          </div>
          <div class="form-group col-md-2">
            <label>แผนก</label>
            <input type="text" class="form-control" name="depratment" placeholder="กรุณาใส่ แผนก" required>
          </div>
          <div class="form-group col-md-3">
            <label>รหัสเครือข่าย</label>
            <input type="text" class="form-control" name="code_network" placeholder="กรุณาใส่ รหัสเครือข่าย" required>
          </div>
          <div class="form-group col-md-2">
            <label>กิจกรรม</label>
            <input type="text" class="form-control" name="activity" placeholder="กรุณาใส่ กิจกรรม" required>
          </div>
          <div class="form-group col-md-2">
            <button type="submit" class="btn btn-gradient-border btn-glow">เพิ่ม</button>
          </div>
        </div>
      </div>
    </form>
    <br><br><br><br>

    <form class="btn-gradient-border ">
      <div class="form-group col">
        <div class="row">
          <div class="form-group col-md-3">
            <label>ราคากลาง</label>
            <input type="text" class="form-control" name="center_price" placeholder="กรุณาใส่ อนุมัติงานก่อสร้าง" required>
          </div>
          <div class="form-group col-md-3">
            <label>เลือกสภาพภูมิประเทศ</label>
            <input type="text" class="form-control" name="TEL" placeholder=" " required>
          </div>
          <div class="form-group col-md-1">
            <label>จำนวน</label>
            <input type="text" class="form-control" name="TEL" placeholder=" " required>
          </div>
          <div class="form-group col-md-3">
            <label>ติดตั้ง/รื้อถอน/นำกลับมาใช้ใหม่</label>
            <input type="text" class="form-control" name="TEL" placeholder=" " required>
          </div>
          <div class="form-group col-md-2">
            <button type="submit" class="btn btn-gradient-border btn-glow">เพิ่ม</button>
          </div>
        </div>
      </div>
    </form>

    <div class="container" id="user">
      <div class="center1">
      </div>
      <form class="btn-gradient-border " action="addemployee.php" method="POST">
        <h1 class="text-gradient">ข้อมูลพนักงาน</h1>
        <br>
        <div class="form-group col-md-2 ">
          <label>รหัสพนักงาน</label>
          <input type="number" class="form-control" name="ID_EMPLOYEE" placeholder="กรุณาใส่รหัสพนักงาน" required>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control"  name="FNAME" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control"  name="LNAME" placeholder="กรุณาใส่นามสกุล" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control"  name="RANK" placeholder="กรุณาใส่ตำแหน่ง" required>
          </div>
          <div class="form-group col-md-3">
            <label>สังกัด</label>
            <input type="text" class="form-control"  name="DEPARTMENT" placeholder="กรุณาใส่สังกัด" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3">
            <label>ชื่อเต็มแผนก</label>
            <input type="text" class="form-control"  name="FULLNAME" placeholder="กรุณาใส่ชื่อเต็มแผนก ex. แผนกก่อสร้าง" required>
          </div>
          <div class="form-group col-md-3">
            <label>เบอร์โทรแผนก</label>
            <input type="text" class="form-control"  name="TEL" placeholder="กรุณาใส่เบอร์โทรแผนก" required>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-gradient-border btn-glow"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>

    <div class="container" id="vender">
      <div class="col offset-md-5">
      </div>
      <form class="btn-gradient-border " action="addvender.php" method="POST">
        <h1 class="text-gradient">ข้อมูลผู้รับจ้าง</h1>
        <br>
        <div class="row">
          <div class="form-group col-md-3 offset-md-6">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control"  name="FNAME_VENDER" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control"  name="LNAME_VENDER" placeholder="กรุณาใส่นามสกุล" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 offset-md-6">
            <label>เลขประจำตัวผู้เสียภาษี</label>
            <input type="text" class="form-control"  name="IDTAX" placeholder="กรุณาใส่ เลขประจำตัวผู้เสียภาษี" required>
          </div>
          <div class="form-group col-md-3">
            <label>Vender List</label>
            <input type="text" class="form-control"  name="VENDER_LIST" placeholder="กรุณาใส่ Vender List" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4 offset-md-6">
            <label>ทะเบียนสมาชิก SME</label>
            <input type="text" class="form-control"  name="SME" placeholder="กรุณาใส่ชื่อ ทะเบียนสมาชิก SME" required>
          </div>
          <div class="form-group col-md-2">
            <label>ลว</label>
            <input type="date" class="form-control" name="DATE" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4 offset-md-6">
            <label>บ้านเลขที่</label>
            <input type="text" class="form-control"  name="ADDRESS" placeholder="กรุณาใส่ บ้านเลขที่" required>
          </div>
          <div class="form-group col-md-2">
            <label>รหัสไปรษณีย์</label>
            <input type="text" class="form-control"  name="POSID" placeholder="กรุณาใส่ รหัสไปรษณีย์" required>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-gradient-border btn-glow"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>

    <div class="container" id="vender">
      <div class="center1">
      </div>
      <form class="btn-gradient-border " action="adddirector.php" method="POST">
        <h1 class="text-gradient">แต่งตั้งคณะกรรมการราคากลาง</h1>
        <br>
        <div class="row">
          <div class="form-group col-md-3 ">

            <label>บันทึกกำหนดราคากลาง</label>
            <input type="text" class="form-control" name="center_price" placeholder="กรุณาใส่ บันทึกกำหนดราคากลาง" required>
          </div>
          <div class="form-group col-md-3">
            <label>ลว</label>
            <input type="date" class="form-control" name="center_price_date" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Chairman_Center_Price" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="Lname_Chairman_Center_Price" placeholder="กรุณาใส่นามสกุล" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_C_C" placeholder="กรุณาใส่ ตำแหน่ง" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>ประธานกรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_1" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_1" placeholder="กรุณาใส่นามสกุล" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_C1" placeholder="กรุณาใส่ ตำแหน่ง" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_2" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_2" placeholder="กรุณาใส่นามสกุล" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_C2" placeholder="กรุณาใส่ ตำแหน่ง" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-gradient-border btn-glow"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>

    <div class="container" id="vender">
      <div class="center1">
      </div>
      <form class="btn-gradient-border ">
        <h1 class="text-gradient">แต่งตั้งคณะกรรมการตรวจรับพัสดุ/ผู้ตรวจรับพัสดุ</h1>
        <br>
        <div class="row">
          <div class="form-group col-md-3 ">

            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Chairman_Check" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Chairman_Check" placeholder="กรุณาใส่นามสกุล" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_C_Check" placeholder="กรุณาใส่ ตำแหน่ง" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>ประธานกรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_Check1" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_Check1" placeholder="กรุณาใส่นามสกุล" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_Check1" placeholder="กรุณาใส่ ตำแหน่ง" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 ">
            <label>ชื่อจริง</label>
            <input type="text" class="form-control" name="FName_Director_Check2" placeholder="กรุณาใส่ชื่อจริง" required>
          </div>
          <div class="form-group col-md-3">
            <label>นามสกุล</label>
            <input type="text" class="form-control" name="LName_Director_Check2" placeholder="กรุณาใส่นามสกุล" required>
          </div>
          <div class="form-group col-md-3">
            <label>ตำแหน่ง</label>
            <input type="text" class="form-control" name="Rank_D_Check2" placeholder="กรุณาใส่ ตำแหน่ง" required>
          </div>
          <div class="form-group col-md-3">
            <br>
            <label>กรรมการ</label>
          </div>
        </div>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-gradient-border btn-glow"> บันทึก </button>
        </div>
      </form>
      <br>
    </div>

  </div>





  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
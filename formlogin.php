<?php
include('connection.php');
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
  <div class="container"  id="margin">
    <br><br>
    <br><br><br>

      <form class="shadow p-3 mb-5 bg-body rounded"  id="form1" action="login.php" method="post">
      <br>
          <div class="center1">
            <h1>LOGIN</h1>
          </div>

          <br>

        <div class="row " >
        <div class="form-group col-md-3">
        </div>
          <div class="form-group col-md-6">
            <label>User name</label>
            <input type="text" class="form-control"  placeholder=""  name="Username"  required>
          </div>
        </div>
        <div class="row">
        <div class="form-group col-md-3">
        </div>
          <div class="form-group col-md-6">
            <label>Pass word</label>
            <input type="text" class="form-control" name="Password" placeholder="" required>
          </div>
        </div>
       
        <br>
        <br>
        <div class="center1">
          <button type="submit" class="btn btn-outline-primary"> Login </button>
        </div>
        <br><br>
      </form>

      


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="assets/jquery.min.js"></script>
  <script src="assets/script.js"></script>
</body>

</html>
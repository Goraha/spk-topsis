<?php
include "koneksi.php";
IF(ISSET($_POST['masuk'])){
$username = $_POST['username'];
$password = $_POST['password']; 
 
 $cek = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_akun WHERE username='$username' AND password='$password'"));
 $data = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM tbl_akun WHERE username='$username' AND password='$password'"));
 IF($cek > 0)
 {
    echo "<script language=\"javascript\">alert(\"Selamat Datang  ".$data['username']."\");document.location.href='admin/index.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Password atau Username Salah !!!\");document.location.href='index.php';</script>";
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SPK CUM Caritas HKBP </title>
    <link rel="shortcut icon" href="asset/img/min-logo.png" />
    <link href="asset/css/bootstrap.css" rel="stylesheet">
    <style>
    html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>
</head>
<body class="text-center">
    <form class="form-signin" method="post" action="" enctype="multipart/form-data">
      <img class="mb-4" src="asset/img/min-logo.png" alt="" width="72" height="72">
      <p class="font-weight-normal"><b>CUM Caritas HKBP Pematangsiantar</b></p>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">

      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="masuk" >Login</button>
      <p class="mt-5 mb-3 text-muted">&copy; GA Purba <?php echo date("Y"); ?></p>
    </form>
  </body>
</html>
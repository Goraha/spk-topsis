<?php
include "../include/koneksi.php";
$query = "SELECT * FROM tbl_akun WHERE kd_akun='1'";
$sql = mysqli_query($connect, $query);
$data = mysqli_fetch_array($sql);
?>


<!DOCTYPE html>
<html>

<head>
  <title>SI Mutasi Mutandis Desa Panombean Marjanji</title>
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="../asset/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../asset/bootstrap-glyphicons/css/bootstrap.icon-large.css">
  <link rel="stylesheet" href="../asset/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="../asset/css/font-awesome.min.css">
  <link rel="stylesheet" href="../asset/css/navigasi.css">
  <link rel="stylesheet" href="../asset/css/style.css">
  <link rel="stylesheet" href="../asset/css/font.css">
  <link rel="stylesheet" href="../asset/css/print.min.css">

  <script src="../asset/js/jquery.min.js"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
  <script src="../asset/js/moment.js"></script>
  <script src="../asset/js/reset.js"></script>
  <script src="../asset/js/bootstrap-datetimepicker.min.js"></script>
  <script src="../asset/js/print.min.js"></script>
</head>

<body style="background-color: white;">
  <div class="col-lg-12" align="center">
    <h1><span class="fa fa-user"></span> Akun</h1>

    <div class="col-lg-12">
      <form method="post" action="" enctype="multipart/form-data">

        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-md-offset-3" align="left">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value='<?php echo $data['username']; ?>' required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-md-offset-3" align="left">
              <label>Password</label>
              <input type="password" name="password" class="form-control" value='<?php echo $data['password']; ?>'
                required>
            </div>
          </div>

          <div class="row" style="margin-top: 35px;">
            <div class="col-md-6" style="margin-top: 5px;">
              <button type="submit" name="simpan" class="btn btn-success btn-block"><span class="fa fa-save"></span>
                Simpan </button>
            </div>
            <div class="col-md-6" style="margin-top: 5px;">
              <a href="data_penduduk.php" class="btn btn-danger btn-block"><span class="fa fa-arrow-left"></span>
                Kembali </a>
            </div>
          </div>
        </div> <!-- form-group// -->

      </form>
    </div>

  </div>
</body>

</html>

<?php
include "../include/koneksi.php";
IF(ISSET($_POST['simpan'])){
$username = $_POST['username'];
$password = $_POST['password'];

$query1 = "UPDATE tbl_akun SET username='$username', password='$password' WHERE kd_akun='1'";
$sql1 = mysqli_query($connect, $query1);

  if($sql1){
    echo "<script language=\"javascript\">alert(\"Berhasil Mengubah Data\");document.location.href='akun.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Gagal Mengubah Data\");document.location.href='akun.php';</script>";
  }
}
?>
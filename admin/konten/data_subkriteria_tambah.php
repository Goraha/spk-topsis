<?php
include "../include/koneksi.php";
$kd_kriteria = $_GET['kd_kriteria'];
$query = "SELECT * FROM tbl_kriteria WHERE kd_kriteria='$kd_kriteria'";
$sql = mysqli_query($connect, $query);
$data = mysqli_fetch_array($sql);
?>

<link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<script src="../../asset/js/moment.js"></script>
<script src="../../asset/js/bootstrap-datepicker.js"></script>

<div class="container">

  <div class="row">
    <div class="col-lg-12" align="center">
    <h1><span class="fa fa-users"></span> Tambah Data Subkriteria <?php echo $kd_kriteria; ?>/<?php echo $data['nm_kriteria']; ?></h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12" align="right" style="margin-bottom:25px;">
    <a type="btn" class="btn btn-outline-info" href="data_subkriteria.php" style="float: right;"><i
                class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="border:solid #d1d1d1 1px;border-radius: 8px; padding-top:50px;padding-bottom:50px;">
      <div class="col-lg-12">
        <form method="post" action="" enctype="multipart/form-data">
          <div class="form-group">
            <div class="row">
              <div class="col-md-9" align="left">
                <label>Nama Sub Kriteria</label>
                <input type="text" name="kd_kriteria" value="<?php echo $kd_kriteria; ?>" hidden>
                <input type="text" name="nm_subkriteria" class="form-control" required>
              </div>
              <div class="col-md-3" align="left">
                <label>Nilai</label>
                <input type="number" name="nilai" class="form-control" required>
              </div>
            </div>
            
            <div class="row" style="margin-top: 35px;">
              <div class="col-md-6" style="margin-top: 5px;">
                <button type="submit" name="simpan" class="btn btn-outline-success btn-block"><span class="fa fa-save"></span>
                  Simpan </button>
              </div>
              <div class="col-md-6" style="margin-top: 5px;">
                <a href="data_kriteria_tambah.php" class="btn btn-outline-danger btn-block"><span class="fa fa-refresh"></span>
                  Bersih
                </a>
              </div>
            </div>
          </div> <!-- form-group// -->

        </form>
      </div>

    </div>
  </div>
</div>

<?php
include "../include/koneksi.php";
IF(ISSET($_POST['simpan'])){
$kd_kriteria = $_POST['kd_kriteria'];
$nm_subkriteria = $_POST['nm_subkriteria'];
$nilai = $_POST['nilai'];

$query = "INSERT INTO tbl_subkriteria VALUES('','$kd_kriteria','$nm_subkriteria','$nilai')";
$sql = mysqli_query($connect, $query);
  if($sql){
    echo "<script language=\"javascript\">alert(\"Berhasil Menambah Data\");document.location.href='data_subkriteria.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Gagal Menambah Data\");document.location.href='data_subkriteria.php';</script>";
  }
}
?>
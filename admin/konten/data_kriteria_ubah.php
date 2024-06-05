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
    <h1><span class="fa fa-users"></span> Ubah Data Kriteria</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12" align="right" style="margin-bottom:25px;">
    <a type="btn" class="btn btn-outline-info" href="data_kriteria.php" style="float: right;"><i
                class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="border:solid #d1d1d1 1px;border-radius: 8px; padding-top:50px;padding-bottom:50px;">
      <div class="col-lg-12">
        <form method="post" action="" enctype="multipart/form-data">
          <div class="form-group">
            <div class="row">
              <div class="col-md-3" align="left">
                <label>Kode Kriteria</label>
                <input type="text" name="kd_kriteria" value="<?php echo $kd_kriteria; ?>" class="form-control" required>
                <input type="text" name="kd_awal" value="<?php echo $kd_kriteria; ?>" hidden>
              </div>
              <div class="col-md-9" align="left">
                <label>Nama Kriteria</label>
                <input type="text" name="nm_kriteria" class="form-control" value="<?php echo $data['nm_kriteria']; ?>" required>
              </div>
            </div>
            <div class="row" style="margin-top: 5px;">
              <div class="col-md-3" align="left">
                <label>Atribut</label>
                <select id="inputState" class="form-control" name="atribut" required>
                <option disabled="disabled" selected="selected" value="">--Pilih--</option>
                  <?php
                                $query = "SELECT atribut FROM tbl_kriteria WHERE kd_kriteria='$kd_kriteria'";
                                $sql = mysqli_query($connect, $query);
                                $data1 = mysqli_fetch_array($sql);
                                $atribut=$data1['atribut'];
                              ?>
                  <option value="benefit" <?php if($atribut=="benefit"){echo "selected";}else{} ?>>Benefit</option>
                  <option value="cost" <?php if($atribut=="cost"){echo "selected";}else{} ?>>Cost</option>
                </select>
              </div>
              <div class="col-md-3" align="left">
                <label>Bobot</label>
                <input type="number" name="bobot" class="form-control" value="<?php echo $data['bobot']; ?>" required>
              </div>
            </div>

            <div class="row" style="margin-top: 35px;">
              <div class="col-md-6" style="margin-top: 5px;">
                <button type="submit" name="simpan" class="btn btn-outline-success btn-block"><span class="fa fa-save"></span>
                  Simpan </button>
              </div>
              <div class="col-md-6" style="margin-top: 5px;">
                <a href="data_kriteria_ubah.php?kd_kriteria=<?php echo $kd_kriteria; ?>" class="btn btn-outline-danger btn-block"><span class="fa fa-refresh"></span>
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
$kd_awal = $_POST['kd_awal'];
$kd_kriteria = $_POST['kd_kriteria'];
$nm_kriteria = $_POST['nm_kriteria'];
$atribut = $_POST['atribut'];
$bobot = $_POST['bobot'];

$query = "UPDATE tbl_kriteria SET kd_kriteria='".$kd_kriteria."', nm_kriteria='".$nm_kriteria."', atribut='".$atribut."', bobot='".$bobot."' WHERE kd_kriteria='".$kd_awal."'";

$sql = mysqli_query($connect, $query);
  if($sql){
    echo "<script language=\"javascript\">alert(\"Berhasil Mengubah Data\");document.location.href='data_kriteria.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Gagal Mengubah Data\");document.location.href='data_kriteria.php';</script>";
  }
}
?>
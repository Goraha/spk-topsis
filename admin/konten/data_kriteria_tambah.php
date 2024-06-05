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
    <h1><span class="fa fa-users"></span> Tambah Data Kriteria</h1>
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
                <input type="text" name="kd_kriteria" class="form-control" required>
              </div>
              <div class="col-md-9" align="left">
                <label>Nama Kriteria</label>
                <input type="text" name="nm_kriteria" class="form-control" required>
              </div>
            </div>
            <div class="row" style="margin-top: 5px;">
              <div class="col-md-3" align="left">
                <label>Atribut</label>
                <select id="inputState" class="form-control" name="atribut" required>
                  <option disabled="disabled" selected="selected" value="">--Pilih--</option>
                  <option value="benefit">Benefit</option>
                  <option value="cost">Cost</option>
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
$nm_kriteria = $_POST['nm_kriteria'];
$atribut = $_POST['atribut'];
$bobot = $_POST['bobot'];

$query = "INSERT INTO tbl_kriteria VALUES('$kd_kriteria','$nm_kriteria','$atribut','$bobot')";
$sql = mysqli_query($connect, $query);
  if($sql){

    // for($i=1; $i <= 5; $i++){
    //     $query = "INSERT INTO tbl_subkriteria VALUES('','$kd_kriteria','','$i')";
    //     $sql = mysqli_query($connect, $query);
    //     //echo "<script language=\"javascript\">alert(\"$query\");</script>";
    // }
    echo "<script language=\"javascript\">alert(\"Berhasil Menambah Data\");document.location.href='data_kriteria.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Gagal Menambah Data\");document.location.href='data_kriteria.php';</script>";
  }
}
?>
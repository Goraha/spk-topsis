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
      <h1><span class="fa fa-users"></span> Tambah Data Anggota</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" align="right" style="margin-bottom:25px;">
      <a type="btn" class="btn btn-outline-info" href="data_anggota.php" style="float: right;"><i
            class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="border:solid #d1d1d1 1px;border-radius: 8px; padding-top:50px;padding-bottom:50px;">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3" align="left">
              <label>Nomor Buku Anggota</label>
              <input type="text" name="nba" class="form-control" required>
            </div>
            <div class="col-md-9" align="left">
              <label>Nama Lengkap</label>
              <input type="text" name="nm_lengkap" class="form-control" required>
            </div>
          </div>
          <div class="row" style="margin-top: 5px;">
            <div class="col-md-3" align="left">
              <label>Jenis Kelamin</label>
              <select id="inputState" class="form-control" name="jk" required>
                <option disabled="disabled" selected="selected" value="">--Pilih--</option>
                <option value="P">PEREMPUAN</option>
                <option value="L">LAKI-LAKI</option>
              </select>
            </div>
            <div class="col-md-3" align="left">
              <label>Tanggal Lahir</label>
              <div class="input-group mb-3">
                <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
                <div class="input-group-append">
                  <button class="btn btn-secondary" id="tgl" type="button"><i class="fa fa-calendar"></i></button>
                </div>
              </div>
            </div>
            <div class="col-md-6" align="left">
              <label>Pekerjaan</label>
              <input type="text" name="pekerjaan" class="form-control" required>
            </div>
          </div>

          <div class="row" style="margin-top: 35px;">
            <div class="col-md-6" style="margin-top: 5px;">
              <button type="submit" name="simpan" class="btn btn-outline-success btn-block"><span class="fa fa-save"></span>
                Simpan </button>
            </div>
            <div class="col-md-6" style="margin-top: 5px;">
              <a href="data_anggota_tambah.php" class="btn btn-outline-danger btn-block"><span class="fa fa-refresh"></span>
                Bersih
              </a>
            </div>
          </div>
        </div> <!-- form-group// -->

      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('#sandbox-container .input-group.date').datepicker({
    format: 'yyyy-mm-dd'
  });
  $('#tgl').datepicker({
    format: 'yyyy-mm-dd'
  }).on('changeDate', function (ev) {
    $('#button').datepicker('hide');
    var thn = ev.date;

    function formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2)
        month = '0' + month;
      if (day.length < 2)
        day = '0' + day;

      return [year, month, day].join('-');
    }
    $('#tgl_lahir').val(formatDate(thn));
  });
</script>


<?php
include "../include/koneksi.php";
IF(ISSET($_POST['simpan'])){
$nba = $_POST['nba'];
$nm_lengkap = $_POST['nm_lengkap'];
$jk = $_POST['jk'];
$tgl_lahir = $_POST['tgl_lahir'];
$pekerjaan = $_POST['pekerjaan'];

$query = "INSERT INTO tbl_anggota VALUES('$nba','$nm_lengkap','$tgl_lahir','$jk','$pekerjaan')";
$sql = mysqli_query($connect, $query);
  if($sql){
    echo "<script language=\"javascript\">alert(\"Berhasil Menambah Data\");document.location.href='data_anggota.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Gagal Menambah Data\");document.location.href='data_anggota.php';</script>";
  }
}
?>
<?php
$now = date("Y-m-d");
$sampai =  date('Y-m-d', strtotime($now. ' + 1 days'));

include "../include/koneksi.php";
$kd_alternatif = "";
$cek = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_hasil"));
if($cek > 0)
{
  $query = "SELECT max(kd_hasil) as maxKode FROM tbl_hasil";
  $hasil = mysqli_query($connect,$query);
  $data = mysqli_fetch_array($hasil);
  $kd_hasil = $data['maxKode'];
  $noUrut = $cek;
  $noUrut++;

  $char = "SPK-";
  $kd_hasil = $char . sprintf("%04s", $noUrut);
}else{
    $kd_hasil = "SPK-0001";
}

$data_alter_arr = json_decode(base64_decode($_POST['data_alter_arr'])); // Server side
$kd_kriteria_arr = json_decode(base64_decode($_POST['kd_kriteria_arr'])); // Server side
$sub_terbobot = json_decode(base64_decode($_POST['sub_terbobot'])); // Server side
$solusi_pos = json_decode(base64_decode($_POST['solusi_pos'])); // Server side
$solusi_neg = json_decode(base64_decode($_POST['solusi_neg'])); // Server side
$solusi_alter = json_decode(base64_decode($_POST['solusi_alter'])); // Server side
$nilai_pref = json_decode(base64_decode($_POST['nilai_pref'])); // Server side

usort($nilai_pref, function($a, $b) {
    return $b[3] <=> $a[3];
});

$po_nilai_pref = base64_encode(json_encode($nilai_pref)); // Client side
?>


<link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">
<style>
  .aas {
    box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2);
  }

  html {
    font-size: 12px;
  }

  .modal-dialog {
    position: fixed;
    top: auto;
    right: 30%;
    left: 30%;
    bottom: 20%;
  }
  .dataTables_filter {
    display: none;
  }
</style>
<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<script src="../../asset/js/moment.js"></script>
<script src="../../asset/js/bootstrap-datepicker.js"></script>


<div class="container">
  <div class="row">
    <div class="col-lg-12" align="center">
      <h1><span class="fa fa-users"></span> Simpan Hasil Perhitungan</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6" align="right" style="margin-bottom:25px;">
      <button class="btn btn-outline-info btn-block" onclick="goBack()"><i class="fa fa-arrow-left"></i> Kembali</button>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="border:solid #d1d1d1 1px;border-radius: 8px; padding-top:50px;padding-bottom:50px;">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3" align="left">
              <label>Kode Periode</label>
              <input type="text" name="tgl_simpan" value="<?php echo $now;?>" hidden>
              <input type="hidden" name="nilai_pref" value="<?php echo $po_nilai_pref; ?>" />
              <input type="text" name="kd_hasil" value="<?php echo $kd_hasil;?>" class="form-control" required>
            </div>
            <div class="col-md-3" align="left">
              <label>Dari</label>
              <div class="input-group mb-3">
                <input type="text" name="tgl_dari" class="form-control" id="tgl_dari" value="<?php echo $now;?>" required>
                <div class="input-group-append">
                  <button class="btn btn-secondary" id="btn_tgl_dari" type="button"><i class="fa fa-calendar"></i></button>
                </div>
              </div>
            </div>
            <div class="col-md-3" align="left">
              <label>Sampai</label>
              <div class="input-group mb-3">
                <input type="text" name="tgl_sampai" class="form-control" id="tgl_sampai" value="<?php echo $sampai;?>" required>
                <div class="input-group-append">
                  <button class="btn btn-secondary" id="btn_tgl_sampai" type="button"><i class="fa fa-calendar"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 5px;">
            <div class="col-md-12" align="left">
              <label>Keterangan</label>
              <textarea name="ket" class="form-control" id="" cols="30" rows="4" required>-</textarea>
            </div>
          </div>

          <div class="row" style="margin-top: 35px;">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="example" class="table table-bordered data" style="font-size:12px;">
                <thead>
                  <tr style="">
                    <th class="text-center">KD Alternatif</th>
                    <th class="text-center">KD Anggota</th>
                    <th class="text-center">Nama Lengkap</th>
                    <th class="text-center">Nilai Preferensi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php
                      $n=count($nilai_pref);
                      for($i=0; $i<$n; $i++){
                        $idx2=3;
                      
                    ?>
                    <td class="text-center align-middle"><?php echo $nilai_pref[$i][0]; ?></td>
                    <td class="text-center align-middle"><?php echo $nilai_pref[$i][1]; ?></td>
                    <td class="text-center align-middle"><?php echo $nilai_pref[$i][2]; ?></td>
                    <td class="text-right align-middle"><?php echo $nilai_pref[$i][3]; ?></td>
                    
                  </tr>
                    <?php
                      $idx2++;   
                      }
                    ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 35px;">
            <div class="col-md-6" style="margin-top: 5px;">
              <button type="submit" name="save" class="btn btn-outline-success btn-block"><span class="fa fa-save"></span>
                Simpan </button>
            </div>
            <div class="col-md-6" style="margin-top: 5px;">
              <a href="perhitungan.php" class="btn btn-outline-danger btn-block"><span class="fa fa-refresh"></span>
                Batal
              </a>
            </div>
          </div>
        </div> <!-- form-group// -->

      </form>
    </div>
  </div>
</div>


<script type="text/javascript">

  $('#btn_tgl_dari').datepicker({
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
    $('#tgl_dari').val(formatDate(thn));
  });

  $('#btn_tgl_sampai').datepicker({
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
    $('#tgl_sampai').val(formatDate(thn));
  });
</script>
<script>
function goBack() {
  window.history.back();
}
</script>



<?php
IF(ISSET($_POST['save'])){
include "../include/koneksi.php";
$tgl_simpan= $_POST['tgl_simpan'];
$nilai_pref= $_POST['nilai_pref'];
$kd_hasil = $_POST['kd_hasil'];
$tgl_dari= $_POST['tgl_dari'];
$tgl_sampai= $_POST['tgl_sampai'];
$ket = $_POST['ket'];
$nilai_pref = json_decode(base64_decode($_POST['nilai_pref'])); // Server side
$n=count($nilai_pref);

$query = "INSERT INTO tbl_hasil VALUES('$kd_hasil','$tgl_simpan','$tgl_dari','$tgl_sampai','$ket')";
$sql = mysqli_query($connect, $query);
//echo $query.'<br>';
  if($sql){


    for($i=0; $i<$n; $i++){
      $a= $nilai_pref[$i][0];
      $b= $nilai_pref[$i][1];
      $c= $nilai_pref[$i][2];
      $d= $nilai_pref[$i][3];
      $query = "INSERT INTO tbl_hasil_detail VALUES('','$kd_hasil','$b','$a','$c','$d')";
      $sql = mysqli_query($connect, $query);
      //echo $query.'<br>';

    }
    echo "<script language=\"javascript\">alert(\"Berhasil Menyimpan Data\");document.location.href='data_hasil.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Gagal Menyimpan Data\");document.location.href='data_hasil.php';</script>";
  }
}
?>
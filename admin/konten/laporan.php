<?php
  include "../include/koneksi.php";
  $tgl_dari = $_POST['tgl_dari'];
  $tgl_sampai = $_POST['tgl_sampai'];

  $query = "SELECT COUNT(*) AS ttl_kedatangan FROM tbl_kedatangan WHERE tgl_kedatangan>='$tgl_dari' && tgl_kedatangan<='$tgl_sampai'";
  $sql = mysqli_query($connect, $query);
  $data_kedatangan = mysqli_fetch_array($sql);
  $ttl_kedatangan = $data_kedatangan['ttl_kedatangan'];

  $query = "SELECT COUNT(*) AS ttl_kelahiran FROM tbl_kelahiran WHERE tgl_pendataan>='$tgl_dari' && tgl_pendataan<='$tgl_sampai'";
  $sql = mysqli_query($connect, $query);
  $data_kelahiran = mysqli_fetch_array($sql);
  $ttl_kelahiran = $data_kelahiran['ttl_kelahiran'];

  $query = "SELECT COUNT(*) AS ttl_kematian FROM tbl_kematian WHERE tgl_kematian>='$tgl_dari' && tgl_kematian<='$tgl_sampai'";
  $sql = mysqli_query($connect, $query);
  $data_kematian = mysqli_fetch_array($sql);
  $ttl_kematian = $data_kematian['ttl_kematian'];

  $query = "SELECT COUNT(*) AS ttl_kepindahan FROM tbl_kepindahan WHERE tgl_kepindahan>='$tgl_dari' && tgl_kepindahan<='$tgl_sampai'";
  $sql = mysqli_query($connect, $query);
  $data_kepindahan = mysqli_fetch_array($sql);
  $ttl_kepindahan = $data_kepindahan['ttl_kepindahan'];

  $query = "SELECT COUNT(*) AS ttl_penduduk  FROM tbl_penduduk WHERE status='Aktif'";
  $sql = mysqli_query($connect, $query);
  $data_penduduk = mysqli_fetch_array($sql);
  $ttl_penduduk = $data_penduduk['ttl_penduduk'];



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
  <div class="row">

    <div class="col-md-12">
      <div class="row"  style=" padding: 15px;">
        <div class="table-responsive" id="printarea">
          <table class="table table-bordered">
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-center" colspan="2"><h1>Laporan Mutasi Mutandis</h1></th>
            </tr>
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-right" colspan="2" align="right">Tanggal : <?php echo $tgl_dari.' s/d '.$tgl_sampai; ?></th>
            </tr>
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-left" align="left">Total Kelahiran</th>
              <td class="text-center"><?php echo $ttl_kelahiran; ?></td>
            </tr>
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-left" align="left">Total Kedatangan</th>
              <td class="text-center"><?php echo $ttl_kedatangan; ?></td>
            </tr>
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-left" align="left">Total Kepindahan</th>
              <td class="text-center"><?php echo $ttl_kepindahan; ?></td>
            </tr>
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-left" align="left">Total Kematian</th>
              <td class="text-center"><?php echo $ttl_kematian; ?></td>
            </tr>
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-left" align="left">Total Penduduk</th>
              <td class="text-center"><?php echo $ttl_penduduk; ?></td>
            </tr>
            <tr class="headerranking" style="background-color: #e8e8e8;">
              <th class="text-left" align="left" colspan="2">
                <div align="right">
                  Pangulu Nagori Panombean Marjanji<br>Kec.Tanah Jawa, Kab.Simalungun
                </div>
                <br><br><br>
                <div align="right">
                  (...............................................................)
                </div>
              </th>
            </tr>
          </table>    
        </div>
      </div>
    </div>

    <div class="col-md-12" align="center" style="margin-top: 25px;">
      <button type="button" name="cetak" class="btn btn-default"onclick="printJS({printable: 'printarea',type: 'html',font_size: '8px;',style : '.headeranalisa{background-color: #ffafc3;} .headernormalisasi{background-color: #fffbaf;} .headerranking{background-color: #e8e8e8;}'})">
        <i class="glyphicon glyphicon-print"></i> Cetak
      </button>
      <a class="btn btn-default" href="laporan_cari.php">Kembali</a>
    </div>

  </div>
</body>
</html>
<script type="text/javascript">
  $(function () {
    $('#datetimepicker1').datetimepicker({
      format: 'YYYY-MM-DD',
    });
    $('#datetimepicker2').datetimepicker({
      format: 'YYYY-MM-DD',
    });
  });
</script>
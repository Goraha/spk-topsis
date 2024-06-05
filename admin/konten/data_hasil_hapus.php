<?php
include "../include/koneksi.php";

$kd_hasil = $_GET['kd_hasil'];

$query = "DELETE FROM tbl_hasil WHERE kd_hasil='".$kd_hasil."'";
$sql = mysqli_query($connect, $query);
  if($sql){
    echo "<script language=\"javascript\">alert(\"Berhasil Menghapus Data\");document.location.href='data_hasil.php';</script>";
  }else{
    echo "<script language=\"javascript\">alert(\"Gagal Menghapus Data\");document.location.href='data_hasil.php';</script>";
  }
?>
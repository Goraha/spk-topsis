<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_spk_caritas";
$connect = mysqli_connect($hostname, $username, $password, $database);
mysqli_connect($hostname,$username,$password) or die ("Koneksi Gagal");
mysqli_select_db($connect,'db_spk_caritas') or die ("Database Tidak Bisa dibuka");
?>
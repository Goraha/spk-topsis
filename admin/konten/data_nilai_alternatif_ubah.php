<?php
include "../include/koneksi.php";
$kd_alternatif = $_GET['kd_alternatif'];
$query = "SELECT * FROM tbl_alternatif WHERE kd_alternatif='$kd_alternatif'";
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


<div class="col-lg-12" align="center">
  <h1><span class="fa fa-users"></span> Ubah Data Nilai Alternatif</h1>

  <div class="col-lg-12">
    <form method="post" action="" enctype="multipart/form-data">
    <input type="text" name="kd_alternatif" value="<?php echo $kd_alternatif; ?>" hidden>
      <div class="col-xs-12 col-md-12 col-lg-12" style="margin-bottom: 15px;">
        <a type="btn" class="btn btn-default" href="data_nilai_alternatif.php" style="float: right;"><i
            class="fa fa-arrow-left"></i> Kembali</a>
      </div>

      <div class="form-group">
        <div class="row">
        <?php
                include "../include/data_kon.php";

                $sql2 = $pdo->prepare("SELECT * FROM tbl_kriteria");
                $sql2->execute();
                while($data2 = $sql2->fetch()){
                    $kd_kriteria = $data2['kd_kriteria'];
                ?>
            <div class="col-md-4" align="left">
            <label><?php echo $data2['kd_kriteria'].'/'.$data2['nm_kriteria']; ?></label>
            <select id="inputState" class="form-control" name="kd_subs[]" required>
              <option disabled="disabled" selected="selected" value="">--Pilih--</option>
              <?php
                include "../include/data_kon.php";

                $sql3 = $pdo->prepare("SELECT * FROM tbl_subkriteria WHERE kd_kriteria='$kd_kriteria'");
                $sql3->execute();
                while($data3 = $sql3->fetch()){
                    $kd_subkriteriax= $data3['kd_subkriteria'];
                ?>
                <?php
                        include "../include/koneksi.php";
                            $query5 = "SELECT * FROM tbl_nilai_alternatif where kd_alternatif= '$kd_alternatif' and kd_subkriteria ='$kd_subkriteriax'";
                            $sql5 = mysqli_query($connect, $query5);
                            $data5 = mysqli_fetch_array($sql5);
                            
                          ?>
                          
              <option value="<?php echo $kd_subkriteriax; ?>" <?php if($kd_subkriteriax==$data5['kd_subkriteria']){echo "selected";}else{} ?>><?php echo $data3['nm_subkriteria']; ?></option>
              
                <?php 
                    }
                ?>
            </select>
          </div>
                <?php 
                }
                ?>
          
        </div>

        <div class="row" style="margin-top: 35px;">
          <div class="col-md-6" style="margin-top: 5px;">
            <button type="submit" name="simpan" class="btn btn-success btn-block"><span class="fa fa-save"></span>
              Simpan </button>
          </div>
          <div class="col-md-6" style="margin-top: 5px;">
            <a href="data_nilai_alternatif_ubah.php?kd_alternatif=<?php echo $kd_alternatif; ?>" class="btn btn-danger btn-block"><span class="fa fa-arrow-left"></span>
              Bersih
            </a>
          </div>
        </div>
      </div> <!-- form-group// -->

    </form>
  </div>

</div>


<script type="text/javascript">
$('#sandbox-container input').datepicker({
  format: 'yyyy-mm-dd',
});
</script>


<?php

include "../include/koneksi.php";
IF(ISSET($_POST['simpan'])){

$kd_alternatif= $_POST['kd_alternatif'];
$arr = $_POST['kd_subs'];
$n = count($arr);
//echo "<script language=\"javascript\">alert(\"$n\");</script>";
    for($i=0; $i < $n; $i++){
      $kd_sub=$arr[$i];
      //echo "<script language=\"javascript\">alert(\"$var\");</script>";
      $cek = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_nilai_alternatif where kd_alternatif= '$kd_alternatif' and kd_subkriteria ='$kd_sub'"));
      IF($cek > 0){
        $query = "DELETE FROM tbl_nilai_alternatif WHERE kd_alternatif= '$kd_alternatif' and kd_subkriteria ='$kd_sub'";
        $sql = mysqli_query($connect, $query);

        $query7 = "INSERT INTO tbl_nilai_alternatif VALUES('','$kd_alternatif','$kd_sub')";
        $sql7 = mysqli_query($connect, $query7);
      }else{
        $query = "INSERT INTO tbl_nilai_alternatif VALUES('','$kd_alternatif','$kd_sub')";
        $sql = mysqli_query($connect, $query);
      }
    }
    echo "<script language=\"javascript\">alert(\"Berhasil Mengubah Data\");document.location.href='data_nilai_alternatif.php';</script>";
}
?>
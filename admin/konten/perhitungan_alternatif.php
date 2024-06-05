<?php
  
  include "../include/data_kon.php";
  $sql = $pdo->prepare("SELECT * FROM tbl_alternatif ORDER BY kd_alternatif DESC");
  $sql->execute();
  $total_alter=0;
  while($data = $sql->fetch()){
    $total_alter++;
  }

  if($total_alter>1){

  $sql = $pdo->prepare("SELECT * FROM tbl_kriteria");
  $sql->execute();
  while($data = $sql->fetch()){
    $kd_kriteria_arr[] = $data['kd_kriteria'];

  }
  
  $data_alter = array(array());
  $sql2 = $pdo->prepare("SELECT * FROM tbl_alternatif as a left join tbl_anggota as b on a.nba=b.nba ORDER BY a.kd_alternatif ASC");
  $sql2->execute();
    $idx=0;
    
    while($data2 = $sql2->fetch()){
      $idx2=0;
      $data_alter[$idx][$idx2]=$data2['kd_alternatif'];
      $idx2=1;
      $data_alter[$idx][$idx2]=$data2['nba'];
      $idx2=2;
      $data_alter[$idx][$idx2]=$data2['nm_lengkap'];
      $idx2++;

      $lim= count($kd_kriteria_arr);
      for ($i=0; $i < $lim; $i++) {
        $kd_krit = $kd_kriteria_arr[$i];
        $sql3 = $pdo->prepare("SELECT * FROM tbl_nilai_alternatif left join tbl_subkriteria on tbl_nilai_alternatif.kd_subkriteria = tbl_subkriteria.kd_subkriteria left join tbl_kriteria on tbl_subkriteria.kd_kriteria = tbl_kriteria.kd_kriteria WHERE kd_alternatif='".$data2['kd_alternatif']."' AND tbl_kriteria.kd_kriteria = '$kd_krit'");
        $sql3->execute();
        
        if($data3 = $sql3->fetch()){
          $data_alter[$idx][$idx2]=$data3['nilai'];
          //echo $data3['nm_subkriteria'];
        }else{
          $data_alter[$idx][$idx2]='0';
          //echo "-";
        }
        $idx2++;      
      }
      $idx++;
    }
    $n=count($kd_kriteria_arr);
    for($i=0; $i<$n; $i++){
      //echo $kd_kriteria_arr[$i];
    }
    $po_kd_kriteria = base64_encode(json_encode($kd_kriteria_arr)); // Client side
    $po_data_alter = base64_encode(json_encode($data_alter)); // Client side
    //echo var_dump($data_alter);
?>


<link rel="stylesheet" href="../../asset/css/bootstrap.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<script src="../../asset/js/bootstrap-datepicker.js"></script>

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
</style>
<div class=container>
  <div class=row>
    
    <div class="col-lg-12" style="margin-top:20px;margin-bottom:25px;">
      <div class=row>
        <div class="col-lg-6">
          <button class="btn btn-outline-info btn-block" onclick="goBack()"><i class="fa fa-arrow-left"></i>
            Kembali</button>
        </div>
        <div class="col-lg-6">
          <form method="post" action="perhitungan_tahap_1.php" enctype="multipart/form-data">
          <input type="hidden" name="data_alter_arr" value="<?php echo $po_data_alter; ?>" />
          <input type="hidden" name="kd_kriteria_arr" value="<?php echo $po_kd_kriteria; ?>" />
          <button type="submit" name="simpan" class="btn btn-outline-info btn-block">
            <i class="fa fa-arrow-right"></i> Berikutnya
          </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-12" align="center" style="margin-bottom:10px;">
      <h1><i class="fa fa-pencil-square-o"></i> Data Alternatif</h1>
    </div>

    <div class="col-lg-12"style="margin-bottom:10px;">
      Berikut adalah anggota yang menjadi alternatif :
    </div>

    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered" style="">
          <tr style="">
            <th class="text-center">KD Alternatif</th>
            <th class="text-center">Nama Lengkap</th>
            <?php
            unset($kd_kriteria_arr);
                    include "../include/data_kon.php";
                    $sql = $pdo->prepare("SELECT * FROM tbl_kriteria");
                    $sql->execute();
                    while($data = $sql->fetch()){
                      $kd_kriteria_arr[] = $data['kd_kriteria'];
                  ?>
            <th class="text-center"><?php echo $data['nm_kriteria']; ?></th>
            <?php
                    }
                  ?>
          </tr>
          <?php
                  include "../include/data_kon.php";
                  $sql2 = $pdo->prepare("SELECT * FROM tbl_alternatif as a left join tbl_anggota as b on a.nba=b.nba ORDER BY a.kd_alternatif ASC");
                  $sql2->execute();
                  while($data2 = $sql2->fetch()){
                ?>
          <tr>
            <td class="text-center align-middle" style="padding:0px;"><?php echo $data2['kd_alternatif']; ?></td>
            <td class="text-center align-middle"><?php echo $data2['nm_lengkap']; ?></td>
            <?php
                    $lim= count($kd_kriteria_arr);
                    for ($i=0; $i < $lim; $i++) {
                      $kd_krit = $kd_kriteria_arr[$i];            
                  ?>
            <td class="text-center  align-middle">
              <?php
                    include "../include/data_kon.php";
                    $sql3 = $pdo->prepare("SELECT * FROM tbl_nilai_alternatif left join tbl_subkriteria on tbl_nilai_alternatif.kd_subkriteria = tbl_subkriteria.kd_subkriteria left join tbl_kriteria on tbl_subkriteria.kd_kriteria = tbl_kriteria.kd_kriteria WHERE kd_alternatif='".$data2['kd_alternatif']."' AND tbl_kriteria.kd_kriteria = '$kd_krit'");
                    $sql3->execute();
                    if($data3 = $sql3->fetch()){
                      echo $data3['nm_subkriteria'];
                    }else{
                      echo "-";
                    }
                  ?>
            </td>
            <?php
                    }
                  ?>

          </tr>
          <?php
                  }
                  unset($kd_kriteria_arr); 
                ?>
        </table>
      </div>
    </div>

  </div>
</div>

<script>
  function goBack() {
    window.history.back();
  }
</script>



<?php
  }else{
    echo "<script language=\"javascript\">alert(\"Jumlah Alternatif minimal 2 !\");document.location.href='data_alternatif.php';</script>";
  }
?>
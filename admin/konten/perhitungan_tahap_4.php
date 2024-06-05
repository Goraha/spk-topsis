<?php
$data_alter_arr = json_decode(base64_decode($_POST['data_alter_arr'])); // Server side
$kd_kriteria_arr = json_decode(base64_decode($_POST['kd_kriteria_arr'])); // Server side
$sub_terbobot = json_decode(base64_decode($_POST['sub_terbobot'])); // Server side
  
include "../include/data_kon.php";
$sql = $pdo->prepare("SELECT * FROM tbl_kriteria");
$sql->execute();
$i=0;
while($data = $sql->fetch()){
  $bobot_kriteria_arr[$i][$i] = $data['bobot'];
  $bobot_kriteria_arr[$i][$i+1] = $data['atribut'];
  $i++;
}

$o=count($data_alter_arr);
$n=count($kd_kriteria_arr);
for($i=0; $i<$o; $i++){
  $sem=0;
  for($j=0; $j<$n; $j++){
    //echo $sub_terbobot[$i][$j].' | ';
  }
  //echo '<br>';
}

//cari solusi positif
  $solusi_pos=array();
  for($j=0; $j<$n; $j++){
    if($bobot_kriteria_arr[$j][$j+1]=="benefit"){
      $solusi_pos[$j]=max(array_column($sub_terbobot, $j));
      //echo max(array_column($sub_terbobot, $j)).' | ';
    }else{
      $solusi_pos[$j]=min(array_column($sub_terbobot, $j));
      //echo min(array_column($sub_terbobot, $j)).' | ';
    }
    
  }
  //echo '<br>';
  //cari solusi negatif
  $solusi_neg=array();
  for($j=0; $j<$n; $j++){
    if($bobot_kriteria_arr[$j][$j+1]=="benefit"){
      $solusi_neg[$j]=min(array_column($sub_terbobot, $j));
      //echo min(array_column($sub_terbobot, $j)).' | ';
    }else{
      $solusi_neg[$j]=max(array_column($sub_terbobot, $j));
      //echo max(array_column($sub_terbobot, $j)).' | ';
    }
    
  }
  //echo '<br>';

$po_kd_kriteria = base64_encode(json_encode($kd_kriteria_arr)); // Client side
$po_data_alter = base64_encode(json_encode($data_alter_arr)); // Client side
$po_sub_terbobot = base64_encode(json_encode($sub_terbobot)); // Client side
$po_solusi_pos = base64_encode(json_encode($solusi_pos)); // Client side
$po_solusi_neg = base64_encode(json_encode($solusi_neg)); // Client side
?>

<link rel="stylesheet" href="../../asset/css/bootstrap.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<script src="../../asset/js/moment.js"></script>
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
          <button class="btn btn-outline-info btn-block" onclick="goBack()"><i class="fa fa-arrow-left"></i> Kembali</button>
        </div>
        <div class="col-lg-6">
          <form method="post" action="perhitungan_tahap_5.php" enctype="multipart/form-data">
          <input type="hidden" name="data_alter_arr" value="<?php echo $po_data_alter; ?>" />
          <input type="hidden" name="kd_kriteria_arr" value="<?php echo $po_kd_kriteria; ?>" />
          <input type="hidden" name="sub_terbobot" value="<?php echo $po_sub_terbobot; ?>" />
          <input type="hidden" name="solusi_pos" value="<?php echo $po_solusi_pos; ?>" />
          <input type="hidden" name="solusi_neg" value="<?php echo $po_solusi_neg; ?>" />
          <button type="submit" name="simpan" class="btn btn-outline-info btn-block">
            <i class="fa fa-arrow-right"></i> Berikutnya
          </button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12" align="center" style="margin-bottom:10px;">
      <h1><i class="fa fa-pencil-square-o"></i> Tahap Matriks Solusi Ideal</h1>
    </div>

    <div class="col-lg-12"style="margin-bottom:10px;">
    Matriks solusi ideal didapat berdasarkan normalisasi terbobot dan atribut kriteria (cost atau benefit).
    <br>-Solusi ideal positif diambil nilai maksimal dari normalisasi terbobot jika atribut kriteria benefit, jika cost diambil nilai minimal.
    <br>-Solusi ideal negatif diambil nilai minimal dari normalisasi terbobot jika atribut kriteria benefit, jika cost diambil maksimal.
    <br>
    Hasilnya bisa dilihat pada tabel berikut:
    </div>

    <!-- data kosong -->
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered" style="">
          <tr style="">
            <th class="text-center"></th>
              <?php
                $n=count($kd_kriteria_arr);
                
                for($i=0; $i<$n; $i++){
              ?>
              <th class="text-center"><?php echo $kd_kriteria_arr[$i].' | '.$bobot_kriteria_arr[$i][$i+1];?></th>
              <?php
                }
              ?>
          </tr>
          <tr style="">
            <th class="text-center">Positif</th>
              <?php
                $n=count($kd_kriteria_arr);
                
                for($i=0; $i<$n; $i++){
              ?>
              <th class="text-center"><?php echo  $solusi_pos[$i];?></th>
              <?php
                }
              ?>
          <tr style="">
          <tr style="">
            <th class="text-center">Negatif</th>
            <?php
                $n=count($kd_kriteria_arr);
                
                for($i=0; $i<$n; $i++){
              ?>
              <th class="text-center"><?php echo  $solusi_neg[$i];?></th>
              <?php
                }
              ?>
          <tr style="">
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

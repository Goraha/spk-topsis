<?php
$sub_pangkat_arr = array(array());
$data_alter_arr = json_decode(base64_decode($_POST['data_alter_arr'])); // Server side
$kd_kriteria_arr = json_decode(base64_decode($_POST['kd_kriteria_arr'])); // Server side

  
  
  $n=count($kd_kriteria_arr);
  $m=count($data_alter_arr);
  
  $idx2=1;
  for($i=0; $i<$m; $i++){
    $sem=0;
    for($j=0; $j<$n; $j++){
      $sub=$data_alter_arr[$i][$j+3];
      $sub_pangkat_arr[$i][$j]=pow($sub,2);
    }
    
    
  }

  $o=count($sub_pangkat_arr);
  for($i=0; $i<$o; $i++){
    $sem=0;
    for($j=0; $j<$n; $j++){
      $sub=$sub_pangkat_arr[$i][$j];
      //echo $sub;
    }
    //echo '<br>';
    
  }

  //cari Baris total sub setelah dipangkat; 
  $total_sub_pangkat = array();
  foreach($sub_pangkat_arr as $value) {
      foreach($value as $key => $number) {
          (!isset($total_sub_pangkat[$key])) ?
              $total_sub_pangkat[$key] = $number :
              $total_sub_pangkat[$key] += $number;
      }
  }
  
  //print_r($total_sub_pangkat);

  $sub_norm_arr=array(array());
  $jmh_kriteria=count($kd_kriteria_arr);
  $n=count($data_alter_arr);
  for($i=0; $i<$n; $i++){
    $idx2=3;
    for($j=0; $j<$jmh_kriteria; $j++){
      $nilai_sub = $data_alter_arr[$i][$idx2+$j];
      $nilai_sub_pangkat = pow($nilai_sub,2);

      $akar = number_format(sqrt($total_sub_pangkat[$j]), 4);
      $sub_norm=number_format($nilai_sub/$akar, 4);
      $sub_norm_arr[$i][$j]=$sub_norm;
    }
    $idx2++; 
  }
  //echo var_dump($data_alter_arr);


  $po_kd_kriteria = base64_encode(json_encode($kd_kriteria_arr)); // Client side
  $po_data_alter = base64_encode(json_encode($data_alter_arr)); // Client side
  $po_sub_norm = base64_encode(json_encode($sub_norm_arr)); // Client side
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
          <form method="post" action="perhitungan_tahap_3.php" enctype="multipart/form-data">
          <input type="hidden" name="data_alter_arr" value="<?php echo $po_data_alter; ?>" />
          <input type="hidden" name="kd_kriteria_arr" value="<?php echo $po_kd_kriteria; ?>" />
          <input type="hidden" name="sub_norm_arr" value="<?php echo $po_sub_norm; ?>" />
          <button type="submit" name="simpan" class="btn btn-outline-info btn-block">
            <i class="fa fa-arrow-right"></i> Berikutnya
          </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-12" align="center" style="margin-bottom:10px;">
      <h1><i class="fa fa-pencil-square-o"></i> Tahap Matriks Normalisasi</h1>
    </div>
    
    <div class="col-lg-12"style="margin-bottom:10px;">
    Tahap pertama normalisasi kita harus mengkuadratkan setiap elemen matriks subkriteria alternatif
    <br>
    Hasilnya seperti berikut:
    </div>

        <!-- data kosong -->
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered" style="">
          <tr style="">
            <th class="text-center">KD Alternatif</th>
              <?php
                $n=count($kd_kriteria_arr);
                
                for($i=0; $i<$n; $i++){
              ?>
              <th class="text-center"><?php echo $kd_kriteria_arr[$i];?></th>
              <?php
                }
              ?>
          </tr>
          <tr>
            <?php
              $jmh_kriteria=count($kd_kriteria_arr);
              $n=count($data_alter_arr);
              for($i=0; $i<$n; $i++){
                $idx2=3;
            ?>
            <td class="text-center align-middle"><?php echo $data_alter_arr[$i][$idx2-3]; ?></td>
              <?php
                for($j=0; $j<$jmh_kriteria; $j++){
                  $nilai_sub = $data_alter_arr[$i][$idx2+$j];
                  $nilai_sub_pangkat = pow($nilai_sub,2);
                  
                  $akar = number_format(sqrt($total_sub_pangkat[$j]), 4);
                  $sub_norm=number_format($nilai_sub/$akar, 4);
              ?>
            <td class="text-center align-middle">
              <?php echo $nilai_sub.'<sup>2</sup>'.'='.$nilai_sub_pangkat; ?>
            </td>
              <?php
                }
              ?>
          </tr>
            <?php
              $idx2++;   
              }
            ?>
            <tr>
              <td class="text-center align-middle">Total</td>
                <?php
                  $jmh_kriteria=count($kd_kriteria_arr);
                  for($j=0; $j<$jmh_kriteria; $j++){
                    
                ?>
              <td class="text-center align-middle"><?php echo $total_sub_pangkat[$j]; ?></td>
                <?php
                  }
                ?>
            </tr>
        </table>
      </div>
    </div>

    <div class="col-lg-12"style="margin-bottom:10px;">
    Setelah itu di normalisasikan dengan cara membagi setiap elemen matriks subkriteria alternatif dengan akar dari total baris kriteria yang
    bersesuaian.
    <br>
    Hasilnya seperti berikut:
    </div>
        <!-- data 2 -->
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered" style="">
          <tr style="">
            <th class="text-center">KD Alternatif</th>
              <?php
                $n=count($kd_kriteria_arr);
                
                for($i=0; $i<$n; $i++){
              ?>
              <th class="text-center"><?php echo $kd_kriteria_arr[$i];?></th>
              <?php
                }
              ?>
          </tr>
          <tr>
            <?php
              $sub_norm_arr=array(array());
              $jmh_kriteria=count($kd_kriteria_arr);
              $n=count($data_alter_arr);
              for($i=0; $i<$n; $i++){
                $idx2=3;
            ?>
            <td class="text-center align-middle"><?php echo $data_alter_arr[$i][$idx2-3]; ?></td>
              <?php
                for($j=0; $j<$jmh_kriteria; $j++){
                  $nilai_sub = $data_alter_arr[$i][$idx2+$j];
                  $nilai_sub_pangkat = pow($nilai_sub,2);

                  $akar = number_format(sqrt($total_sub_pangkat[$j]), 4);
                  $sub_norm=number_format($nilai_sub/$akar, 4);
                  $sub_norm_arr[$i][$j]=$sub_norm;
              ?>
            <td class="text-center align-middle">
              <?php echo $nilai_sub.' / <span style="white-space: nowrap; font-size:larger">&radic;<span style="text-decoration:overline;">&nbsp;'.$total_sub_pangkat[$j].'&nbsp;</span></span>'.'='.$sub_norm; ?>
            </td>
              <?php
                }
              ?>
          </tr>
            <?php
              $idx2++;   
              }
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

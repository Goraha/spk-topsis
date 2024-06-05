<?php
$data_alter_arr = json_decode(base64_decode($_POST['data_alter_arr'])); // Server side
$kd_kriteria_arr = json_decode(base64_decode($_POST['kd_kriteria_arr'])); // Server side

$po_kd_kriteria = base64_encode(json_encode($kd_kriteria_arr)); // Client side
$po_data_alter = base64_encode(json_encode($data_alter_arr)); // Client side
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
          <form method="post" action="perhitungan_tahap_2.php" enctype="multipart/form-data">
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
      <h1><i class="fa fa-pencil-square-o"></i> Tahap Matriks Keputusan</h1>
    </div>

    <div class="col-lg-12"style="margin-bottom:10px;">
      Langkah pertama adalah membuat matriks keputusan dari data anggota. Dengan mengubah data kriteria anggota/alternatif sesuai dengan nilai subkriteria yang telah ditetukan sebelumnya.
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
              ?>
            <td class="text-center align-middle"><?php echo $data_alter_arr[$i][$idx2+$j]; ?></td>
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
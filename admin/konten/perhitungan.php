<?php
  include "../include/data_kon.php";
  $sql = $pdo->prepare("SELECT * FROM tbl_kriteria");
  $sql->execute();
  $total_krit=0;
  while($data = $sql->fetch()){
    $total_krit++;
  }

  if($total_krit>1){
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
            
        </div>
        <div class="col-lg-6">
          <a type="btn" class="btn btn-outline-info btn-block" href="perhitungan_alternatif.php"><i class="fa fa-arrow-right"></i> Berikutnya</a>
        </div>
      </div>
    </div>

    <div class="col-lg-12" align="center" style="margin-bottom:10px;">
      <h1><i class="fa fa-pencil-square-o"></i> Data Kriteria & Subkriteria</h1>
    </div>
    
    <div class="col-lg-12"style="margin-bottom:10px;">
      Berikut adalah Kriteria dan Subkriteria yang digunakan :
    </div>
    

          <script type="text/javascript">
            var bobot_kriteria = [];
            var atribut_kriteria = [];
          </script>
          <?php
                  include "../include/data_kon.php";

                  $sql = $pdo->prepare("SELECT * FROM tbl_kriteria");
                  $sql->execute();
                  $ttl_kriteria =1;
                  while($data = $sql->fetch()){
                      $vv = $data['atribut'];
                  ?>
            <script type="text/javascript">
              var foo = <?=json_encode($data['atribut'])?>;
              bobot_kriteria.push(<?php echo $data['bobot']; ?>);
              atribut_kriteria.push(foo);
            </script>

          <?php
              $ttl_kriteria++;}
            ?>

    
    <div class="col-lg-12">
      <div class="row">



        <?php
            include "../include/data_kon.php";
            $sql = $pdo->prepare("SELECT * FROM tbl_kriteria ");
            $sql->execute();
            while($data = $sql->fetch()){
            $kd_kriteria = $data['kd_kriteria'];
        ?>


        <div class="col-lg-4">
            <div class="table-responsive">
                <form method="post" action="" enctype="multipart/form-data">
                    <table class="table table-bordered"
                        style="">
                        <tr style="">
                            <th class="text-left align-center"  colspan="2">Kriteria <?php echo $data['kd_kriteria'].'/'.$data['nm_kriteria']; ?> | Atribut : <?php echo $data['atribut']; ?> | Bobot : <?php echo $data['bobot']; ?></th>

                        </tr>
                        <tr style="">
                            <th class="text-center">Subkriteria</th>
                            <th class="text-center">Nilai</th>
                        </tr>
                        <?php
                            include "../include/data_kon.php";
                            $sql1 = $pdo->prepare("SELECT * FROM tbl_subkriteria where kd_kriteria='$kd_kriteria' ORDER BY nilai DESC");
                            $sql1->execute();
                            while($data1 = $sql1->fetch()){
                    ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo $data1['nm_subkriteria']; ?></td>
                            <td class="text-center align-middle"><?php echo $data1['nilai']; ?></td>
                        </tr>
                        <?php
                      
                        }
                    ?>
                    </table>
                </form>
            </div>
        </div>
        <?php             
            }
        ?>

      </div>
    </div>

  </div>
</div>


<?php
  }else{
    echo "<script language=\"javascript\">alert(\"Kriteria Tidak Boleh dibawah 1\");document.location.href='data_kriteria.php';</script>";
  }
?>
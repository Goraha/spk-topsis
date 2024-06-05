<?php

include "../include/koneksi.php";
$kd_alternatif = "";
$cek = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_alternatif"));
if($cek > 0)
{
$query = "SELECT max(kd_alternatif) as maxKode FROM tbl_alternatif";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$kd_alternatif = $data['maxKode'];
$noUrut = (int) substr($kd_alternatif, 3, 4);
$noUrut++;
$char = "A";
$kd_alternatif = $char . sprintf("%04s", $noUrut);
}else{
    $kd_alternatif = "A0001";
}

?>


<link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<script src="../../asset/js/moment.js"></script>
<script src="../../asset/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../datatables/datatables.min.css"/>
<script type="text/javascript" src="../../datatables/datatables.min.js"></script>

<div class="container">
  <div class="row">
    <div class="col-lg-12" align="center">
      <h1><span class="fa fa-users"></span> Tambah Data Alternatif</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" align="right" style="margin-bottom:25px;">
      <a type="btn" class="btn btn-outline-info" href="data_alternatif.php" style="float: right;"><i
            class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="border:solid #d1d1d1 1px;border-radius: 8px; padding-top:50px;padding-bottom:50px;">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3" align="left">
              <label>Kode Alternatif</label>
              <input type="text" name="kd_alternatif" id="kd_alternatif" value="<?php echo $kd_alternatif; ?>" class="form-control" required>
            </div>
            <div class="col-md-3" align="left">
              <label>Kode Anggota</label>
              <div class="input-group mb-3">
                <input type="text" name="nba" class="form-control" id="nba" required>
                <div class="input-group-append">
                  <button class="btn btn-secondary" id="btn_kd" type="button"  data-toggle="modal" data-target="#data_anggota"><i class="fa fa-search"></i> Pilih</button>
                </div>
              </div>
            </div>
            <div class="col-md-6" align="left">
              <label>Nama Lengkap</label>
              <input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control" required>
            </div>
          </div>
          <div class="row" style="margin-top: 5px;">
          <?php
                include "../include/data_kon.php";

                $sql2 = $pdo->prepare("SELECT * FROM tbl_kriteria");
                $sql2->execute();
                while($data2 = $sql2->fetch()){
                    $kd_kriteria = $data2['kd_kriteria'];
              ?>
              <div class="col-lg-3" style="margin-top:10px;">
              
              <label><?php echo $data2['kd_kriteria'].'/'.$data2['nm_kriteria']; ?></label>
              <select id="inputState" class="form-control" name="kd_subs[]" required>
              <option disabled="disabled" selected="selected" value="">--Pilih--</option>
              </div>
                <?php
                  include "../include/data_kon.php";

                  $sql3 = $pdo->prepare("SELECT * FROM tbl_subkriteria LEFT JOIN tbl_kriteria on tbl_subkriteria.kd_kriteria=tbl_kriteria.kd_kriteria WHERE tbl_subkriteria.kd_kriteria='$kd_kriteria'");
                  $sql3->execute();
                  while($data3 = $sql3->fetch()){
                      $kd_subkriteriax= $data3['kd_subkriteria'];
                ?>
                  
                  <option value="<?php echo $kd_subkriteriax; ?>"><?php echo $data3['nm_subkriteria'];?></option>
                  
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
              <button type="submit" name="simpan" class="btn btn-outline-success btn-block"><span class="fa fa-save"></span>
                Simpan </button>
            </div>
            <div class="col-md-6" style="margin-top: 5px;">
              <a href="data_alternatif_tambah.php" class="btn btn-outline-danger btn-block"><span class="fa fa-refresh"></span>
                Bersih
              </a>
            </div>
          </div>
        </div> <!-- form-group// -->

      </form>
    </div>
  </div>
</div>



<!-- Modal -->
<form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
<div class="modal fade bd-example-modal-lg" id="data_anggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
        <table id="example" class="table table-hover table-bordered data" style="font-size:12px;">
                <thead>
                    <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">			
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Anggota</th>
                        <th class="text-center">Nama Lengkap</th>
                        <th class="text-center">Tanggal Lahir</th>
                        <th class="text-center">JK</th>
                        <th class="text-center">Pekerjaan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            include "../include/data_kon.php";
            $sql = $pdo->prepare("SELECT * FROM tbl_anggota");
            $sql->execute();
            $no = 1;
            while($data = $sql->fetch()){
            ?>
            <tr>				
                <td class="align-middle text-center"><b><?php echo $no; ?></b></td>
                <td class="align-middle text-center"><?php echo $data['nba']; ?></td>
                <td class="align-middle text-center"><?php echo $data['nm_lengkap']; ?></td>
                <td class="align-middle text-center"><?php echo $data['tgl_lahir']; ?></td>
                <td class="align-middle text-center"><?php echo $data['jk']; ?></td>
                <td class="align-middle text-center"><?php echo $data['pekerjaan']; ?></td>
                <td class="align-middle text-center" style="padding:0px;">
                <button type="button" class="btn btn-outline-success pilih" data-toggle="modal" data-dismiss="modal" data-target="#forms" data-kd="<?php echo $data['nba']; ?>" data-nm="<?php echo $data['nm_lengkap']; ?>" ><i class="fa fa-close"></i> Pilih</button>
                </td>
                        
            </tr>
            <?php
                $no++;
                }
            ?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
</form>



<script type="text/javascript">
$("#nba").keydown(function(e){
        e.preventDefault();
});
$("#nm_lengkap").keydown(function(e){
        e.preventDefault();
});
$(".pilih").click(function (e) {
        var kd = $(this).attr("data-kd");
        var nm = $(this).attr("data-nm");
        //alert(data);
        $('#nba').val(kd);
        $('#nm_lengkap').val(nm);
    });

	$(document).ready(function(){
        $('#nba').attr("required",true);
		$('.data').DataTable();
        
    
	});

  var stdTable = $('#example').DataTable({});

  $('#cr_kode').on('keyup', function () {
    stdTable
    .columns()
    .search('')
    .column(1)
        .search(this.value)
        .draw();
  });

  $('#cr_nama').on('keyup', function () {
    stdTable
    .columns()
    .search('')
    .column(2)
        .search(this.value)
        .draw();
  });
</script>

<?php

include "../include/koneksi.php";
IF(ISSET($_POST['simpan'])){

$kd_alternatif= $_POST['kd_alternatif'];
$nba= $_POST['nba'];
$arr = $_POST['kd_subs'];
$n = count($arr);
$query = "INSERT INTO tbl_alternatif VALUES('$kd_alternatif','$nba')";
$sql = mysqli_query($connect, $query);
    if($sql){
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
        echo "<script language=\"javascript\">alert(\"Berhasil Menambah Data\");document.location.href='data_alternatif.php';</script>";
    }else{
        echo "<script language=\"javascript\">alert(\"Gagal Menambah Data\");document.location.href='data_alternatif.php';</script>";
    }
}
?>
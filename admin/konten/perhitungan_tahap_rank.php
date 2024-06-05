<?php
$data_alter_arr = json_decode(base64_decode($_POST['data_alter_arr'])); // Server side
$kd_kriteria_arr = json_decode(base64_decode($_POST['kd_kriteria_arr'])); // Server side
$sub_terbobot = json_decode(base64_decode($_POST['sub_terbobot'])); // Server side
$solusi_pos = json_decode(base64_decode($_POST['solusi_pos'])); // Server side
$solusi_neg = json_decode(base64_decode($_POST['solusi_neg'])); // Server side
$solusi_alter = json_decode(base64_decode($_POST['solusi_alter'])); // Server side
$nilai_pref = json_decode(base64_decode($_POST['nilai_pref'])); // Server side

usort($nilai_pref, function($a, $b) {
    return $b[3] <=> $a[3];
});


$po_kd_kriteria = base64_encode(json_encode($kd_kriteria_arr)); // Client side
$po_data_alter = base64_encode(json_encode($data_alter_arr)); // Client side
$po_sub_terbobot = base64_encode(json_encode($sub_terbobot)); // Client side
$po_solusi_pos = base64_encode(json_encode($solusi_pos)); // Client side
$po_solusi_neg = base64_encode(json_encode($solusi_neg)); // Client side
$po_solusi_alter = base64_encode(json_encode($solusi_alter)); // Client side
$po_nilai_pref = base64_encode(json_encode($nilai_pref)); // Client side
?>

<link rel="stylesheet" href="../../asset/css/bootstrap.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<script src="../../asset/js/moment.js"></script>
<script src="../../asset/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../datatables/datatables.min.css"/>
<script type="text/javascript" src="../../datatables/datatables.min.js"></script>
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
  .dataTables_filter {
    display: none;
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
          <form method="post" action="perhitungan_simpan.php" enctype="multipart/form-data">
          <input type="hidden" name="data_alter_arr" value="<?php echo $po_data_alter; ?>" />
          <input type="hidden" name="kd_kriteria_arr" value="<?php echo $po_kd_kriteria; ?>" />
          <input type="hidden" name="sub_terbobot" value="<?php echo $po_sub_terbobot; ?>" />
          <input type="hidden" name="solusi_pos" value="<?php echo $po_solusi_pos; ?>" />
          <input type="hidden" name="solusi_neg" value="<?php echo $po_solusi_neg; ?>" />
          <input type="hidden" name="solusi_alter" value="<?php echo $po_solusi_alter; ?>" />
          <input type="hidden" name="nilai_pref" value="<?php echo $po_nilai_pref; ?>" />
          <button type="submit" name="simpan" class="btn btn-outline-info btn-block">
            <i class="fa fa-save"></i> Simpan
          </button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12" align="center" style="margin-bottom:10px;">
      <h1><i class="fa fa-pencil-square-o"></i> Perangkingan Alternatif</h1>
    </div>

    <div class="col-lg-12"style="margin-bottom:10px;">
    Setelah diketahi nilai prefensi tiap alternatif, maka alternatif diurutkan dari nilai prefensi terbesar sampai yang terkecil.
    <br>
    Hasilnya bisa dilihat pada tabel berikut:
    </div>

    <div class="col-lg-12">
      <div class="table-responsive">
        <table id="example" class="table table-bordered data" style="font-size:12px;">
        <thead>
          <tr style="">
            <th class="text-center">KD Alternatif</th>
            <th class="text-center">KD Anggota</th>
            <th class="text-center">Nama Lengkap</th>
            <th class="text-center">Nilai Preferensi</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <?php
              $n=count($nilai_pref);
              for($i=0; $i<$n; $i++){
                $idx2=3;
               
            ?>
            <td class="text-center align-middle"><?php echo $nilai_pref[$i][0]; ?></td>
            <td class="text-center align-middle"><?php echo $nilai_pref[$i][1]; ?></td>
            <td class="text-center align-middle"><?php echo $nilai_pref[$i][2]; ?></td>
            <?php
                if($nilai_pref[$i][3]>=0.55){
                  
            ?>
                <td class="text-right align-middle bg-success"><?php echo $nilai_pref[$i][3]; ?></td>
            <?php
                }else{
            ?>
                <td class="text-right align-middle  bg-danger"><?php echo $nilai_pref[$i][3]; ?></td>
            <?php
                }
                
            ?>
           
            
          </tr>
            <?php
              $idx2++;   
              }
            ?>
            </tbody>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable({
      "ordering": false,
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
      "bAutoWidth": false,
      dom: 'Bfrtip',
      
        buttons: [
          'copy',
            {
                extend: 'excel',
                messageTop: ''
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
                title: 'Hasil SPK Pengajuan Pinjaman CUM Caritas HKBP Pematangsiantar',
                messageTop: ''
            }
        ]
    });
      
    
	});
</script>
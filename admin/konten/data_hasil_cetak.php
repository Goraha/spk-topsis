<?php
  include "../include/koneksi.php";
  $kd_hasil = $_GET['kd_hasil'];
  $query_hasil = "SELECT kd_hasil,tgl_simpan,DATE_FORMAT(tgl_dari,'%d/%m/%Y') AS tgl_dari,DATE_FORMAT(tgl_sampai,'%d/%m/%Y') AS tgl_sampai,keterangan FROM tbl_hasil WHERE kd_hasil='$kd_hasil'";
  $sql_hasil = mysqli_query($connect, $query_hasil);
  $data_hasil = mysqli_fetch_array($sql_hasil);
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
  .buttonsToHide {
    display: none;
  }

</style>

<div class=container>
  <div class=row>
    <div class="col-lg-12" style="margin-top:20px;margin-bottom:25px;">
      <div class=row>
        <div class="col-lg-12" align="right" style="margin-bottom:25px;">
          <button class="btn btn-outline-info" onclick="goBack()"><i class="fa fa-arrow-left"></i> Kembali</button>
        </div>
        <div class="col-lg-12" align="right">
          <button class="btn btn-outline-info" id="btnPrint"><i class="fa fa-print"></i> Cetak</button>
        </div>
      </div>
    </div>

    <div class="col-lg-12"  style="border:solid #d1d1d1 1px;border-radius: 8px; padding-top:50px;padding-bottom:50px;">
      <div class="col-lg-12" align="center" style="margin-bottom:10px;">
        <h1>Hasil SPK Pengajuan Pinjaman CUM Caritas HKBP Pematangsiantar</h1>
      </div>

      <div class="col-lg-12"style="margin-bottom:10px;">
        <table>
          <tr>
            <td>Kode Hasil</td>
            <td> : <?php echo $data_hasil['kd_hasil']; ?></td>
          </tr>
          <tr>
            <td>Periode</td>
            <td> : <?php echo $data_hasil['tgl_dari'].' s/d '.$data_hasil['tgl_sampai']; ?></td>
          </tr>
        </table>
      </div>

      <div class="col-lg-12" align="right">
        <div class="table-responsive">
          <table id="example" class="table table-bordered data" style="font-size:12px;">
          <thead>
            <tr style="">
              <th class="text-center">No Rank</th>
              <th class="text-center">KD Alternatif</th>
              <th class="text-center">NBA</th>
              <th class="text-center">Nama Lengkap</th>
              <th class="text-center">Nilai</th>
            </tr>
            </thead>
            <tbody>		
            <?php
              include "../include/data_kon.php";
              $sql = $pdo->prepare("SELECT * FROM tbl_hasil_detail WHERE kd_hasil='$kd_hasil'");
              $sql->execute();
              $no = 1;
              while($data = $sql->fetch()){           
            ?>
              <tr>
                <td class="text-center align-middle "><b><?php echo $no; ?></b></td>
                <td class="align-middle text-center"><?php echo $data['kd_alternatif']; ?></td>
                <td class="align-middle text-center"><?php echo $data['nba']; ?></td>
                <td class="align-middle text-center"><?php echo $data['nm_alternatif']; ?></td>
                <td class="align-middle text-center"><?php echo $data['nilai']; ?></td>
              </tr>
            <?php
              $no++;}
            ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-12"style="margin-bottom:10px;">
        <table>
          <tr>
            <td>Keterangan</td>
            <td> : <?php echo $data_hasil['keterangan']; ?></td>
          </tr>
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
  var php_var = "<?php echo $kd_hasil; ?>";
  var tgl_dari = "<?php echo $data_hasil['tgl_dari']; ?>";
  var tgl_sampai = "<?php echo  $data_hasil['tgl_sampai']; ?>";
  var keterangan = "<?php echo  $data_hasil['keterangan']; ?>";
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
            {
                extend: 'copy',
                className: "buttonsToHide",
                messageTop: ''
            },
            {
                extend: 'excel',
                className: "buttonsToHide",
                messageTop: ''
            },
            {
                extend: 'pdf',
                className: "buttonsToHide",
                messageBottom: null
            },
            {
                extend: 'print',
                className: "buttonsToHide",
                title: '',
                messageTop: '',
                customize: function ( win ) {
                    
                    $(win.document.body)
                        .css( 'font-size', '12pt' )
                        .prepend(
                            '<div class="col-lg-12" align="center"><h1>Hasil SPK Pengajuan Pinjaman CUM Caritas HKBP Pematangsiantar</h1></div>'
                            +'<div align="left">'
                              +'<tabled style="width:100%;">'
                              +'<tr>'
                                +'<td style="width:50%;">Kode Hasil</td>'
                                +'<td style="width:50%;"> :'+php_var+'</td>'
                              +'</tr>'
                              +'</tabled>'
                            +'</div>'
                            +'<div align="left">'
                              +'<tabled style="width:100%;">'
                              +'<tr>'
                                +'<td style="width:50%;">Periode</td>'
                                +'<td style="width:50%;">    :'+tgl_dari+' s/d '+tgl_sampai+'</td>'
                              +'</tr>'
                              +'</tabled>'
                            +'</div>'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                        $(win.document.body).append('<div>Keteragan : '+keterangan+'</div>'); //after the table
                }
            }
        ]
    });
      
    
  });
  
  /* custom button event print */
  $(document).on('click', '#btnPrint', function(){
    $(".buttons-print")[0].click(); //trigger the click event
  });
</script>

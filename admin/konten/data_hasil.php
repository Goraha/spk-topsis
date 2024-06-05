<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Date Range - maribelajarcoding.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--bootstrap -->
  <link rel="stylesheet" href="../../asset/css/bootstrap.css">
  <link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../asset/css/font_style.css">
  <!--DataTables -->
  <link rel="stylesheet" type="text/css" href="../../datatables/datatables.min.css"/>
  <!--Daterangepicker -->
  <link rel="stylesheet" type="text/css" href="../../asset/css/daterangepicker.css" />
  <!--Jquery -->
  <script src="../../asset/js/jquery.js"></script>
  <!--Boostrap -->
  <script src="../../asset/js/bootstrap.js"></script>
   <!--DataTables -->
  <script type="text/javascript" src="../../datatables/datatables.min.js"></script>
  <!--DateRangePicker -->
  <script type="text/javascript" src="../../asset/js/moment.min.js"></script>
  <script type="text/javascript" src="../../asset/js/daterangepicker.min.js"></script>
  
  <style>
  .aas {
    box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2);
  }

  html {
    font-size: 12px;
  }
  .dataTables_filter {
    display: none;
  }
</style>
</head>
<body>

<div class="col-lg-12" align="center">
  <h1><span class="fa fa-book"></span> Daftar Hasil</h1>
</div>
<div class="col-lg-12">
  <div class="form-group row">
    <div class="col-lg-6">  
    </div>
    <div class="col-lg-2" align="right">
      <label class="col-sm-2 col-form-label"><b>Cari</b></label>
    </div>
    <div class="col-lg-2">
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" id="datesearch" placeholder="Tgl Periode...">
      </div>
    </div>
    <div class="col-lg-2">
      <input type="text" class="form-control" id="cr_kode" placeholder="Kode Hasil..." autocomplete="off">
    </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="row">
    <div class="col-md-12">
      <table id="example" class="table table-hover table-bordered data" style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
        <thead>
          <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
            <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
            <th class="text-center align-middle" rowspan="2">NO</th>
            <th class="text-center align-middle" rowspan="2">Kode Hasil</th>
            <th class="text-center align-middle" colspan="2">Periode</th>
            <th class="text-center align-middle" rowspan="2">Keterangan</th>
            <th class="text-center align-middle" rowspan="2" style="width: 16.66%">Aksi</th>
          </tr>
          <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
            <th class="text-center align-middle">Dari</th>
            <th class="text-center align-middle">Sampai</th>
          </tr>
          
        </thead>
        <tbody>
        <?php
        include "../include/data_kon.php";
        $sql = $pdo->prepare("SELECT kd_hasil,tgl_simpan,DATE_FORMAT(tgl_dari,'%d/%m/%Y') AS tgl_dari,tgl_sampai,keterangan FROM tbl_hasil");
        $sql->execute();
        $no =1;
        while($data = $sql->fetch()){
        ?>
        <tr>
        <td class="align-middle text-center"><b><?php echo $no; ?></b></td>
          <td class="text-center align-middle"><?php echo $data['kd_hasil']; ?></td>
          <td class="text-center align-middle"><?php echo $data['tgl_dari']; ?></td>
          <td class="text-center align-middle"><?php echo $data['tgl_sampai']; ?></td>
          <td class="text-center align-middle"><?php echo $data['keterangan']; ?></td>
          <td class="text-center align-middle" style="padding:0px;">
            <a class="btn btn-outline-secondary"
              href='data_hasil_cetak.php?kd_hasil=<?php echo $data['kd_hasil']; ?>' style="margin:0px;"><i
                class="fa fa-print"></i> Cetak </a>
            <a class="btn btn-outline-danger" id="tombol-hapus"
              href='data_hasil_hapus.php?kd_hasil=<?php echo $data['kd_hasil']; ?>'
              style="margin:0px;"><i class="fa fa-close"></i> Hapus</a>
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
</div>

  <script type="text/javascript"> 
   //fungsi untuk filtering data berdasarkan tanggal 
   var start_date;
   var end_date;
   var kode;
   var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
      var dateStart = parseDateValue(start_date);
      var dateEnd = parseDateValue(end_date);
      //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
      //nama depan = 0
      //nama belakang = 1
      //tanggal terdaftar =2
      var evalDate= parseDateValue(aData[2]);
        if ( ( isNaN( dateStart ) && isNaN( dateEnd ) ) ||
             ( isNaN( dateStart ) && evalDate <= dateEnd ) ||
             ( dateStart <= evalDate && isNaN( dateEnd ) ) ||
             ( dateStart <= evalDate && evalDate <= dateEnd ) )
        {
            return true;
        }
        return false;
  });

  var KodeFilterFunction = (function (oSettings, aData, iDataIndex) {
      var kds = '1';
      var evalDate= parseDateValue(aData[0]);
      alert(evalDate);
        if ( kds == evalDate)
        {
          return true;
        }else{
          return false;
        }
        
  });

  // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
  function parseDateValue(rawDate) {
      var dateArray= rawDate.split("/");
      var parsedDate= new Date(dateArray[2], parseInt(dateArray[1])-1, dateArray[0]);  // -1 because months are from 0 to 11   
      return parsedDate;
  }    

  $( document ).ready(function() {
  //konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
   var $dTable = $('#example').DataTable({
    "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>"
   });


   document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

   //konfigurasi daterangepicker pada input dengan id datesearch
   $('#datesearch').daterangepicker({
      autoUpdateInput: false
    });

   //menangani proses saat apply date range
    $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
      $('#cr_kode').val('');
       $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
       start_date=picker.startDate.format('DD/MM/YYYY');
       end_date=picker.endDate.format('DD/MM/YYYY');
       $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
       $dTable.draw();
    });

    $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
      $('#cr_kode').val('');
      $(this).val('');
      start_date='';
      end_date='';
      $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
      $dTable.draw();
    });

    var stdTable = $('#example').DataTable({
      "bDestroy": true
    });
    
    $('#cr_kode').on('keyup', function () {
      $('#datesearch').val('');
      stdTable
      .columns()
      .search('')
      .column(1)
          .search(this.value)
          .draw();
    });
  });

</script>
</body>
</html>
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
  
  <style type="text/css">
    .header h2 {
      font-weight: lighter;
      text-align: center;
      margin: 0
    }
    .header h3 {
      font-weight: lighter;
      text-align: center;
      margin: 0
    }
    .number{
      text-align: right;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">maribelajarcoding.com</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
  </div>
</nav>
<div class="container">
  <div class="page-header header">
    <h2>Pencarian berdasarkan Range Tanggal (Datatables)</h2>
    <h3>latihan.html</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table id="example" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Tanggal Terdaftar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Alexa</td>
            <td>Wilder</td>
            <td>01/01/2020</td>
          </tr>
          <tr>
            <td>Avram</td>
            <td>Allison</td>
            <td>05/01/2020</td>
          </tr>
          <tr>
            <td>Basia</td>
            <td>Harrell</td>
            <td>06/01/2020</td>
          </tr>
          <tr>
            <td>Bryar</td>
            <td>Long</td>
            <td>07/01/2020</td>
          </tr>
          <tr>
            <td>Cruz</td>
            <td>Reynolds</td>
            <td>08/01/2020</td>
          </tr>
          <tr>
            <td>Dexter</td>
            <td>Burton</td>
            <td>09/01/2020</td>
          </tr>
          <tr>
            <td>Dustin</td>
            <td>Rosa</td>
            <td>11/01/2020</td>
          </tr>
          <tr>
            <td>Hamilton</td>
            <td>Blackburn</td>
            <td>15/01/2020</td>
          </tr>
          <tr>
            <td>Ifeoma</td>
            <td>Mays</td>
            <td>19/01/2020</td>
          </tr>
          <tr>
            <td>Indigo</td>
            <td>Brennan</td>
            <td>22/01/2020</td>
          </tr>
          <tr>
            <td>Ishmael</td>
            <td>Crosby</td>
            <td>25/01/2020</td>
          </tr>
          <tr>
            <td>Jessica</td>
            <td>Bryan</td>
            <td>30/01/2020</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

  <script type="text/javascript"> 
   //fungsi untuk filtering data berdasarkan tanggal 
   var start_date;
   var end_date;
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

   //menambahkan daterangepicker di dalam datatables
   $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range.."> </div>');

   document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

   //konfigurasi daterangepicker pada input dengan id datesearch
   $('#datesearch').daterangepicker({
      autoUpdateInput: false
    });

   //menangani proses saat apply date range
    $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
       $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
       start_date=picker.startDate.format('DD/MM/YYYY');
       end_date=picker.endDate.format('DD/MM/YYYY');
       $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
       $dTable.draw();
    });

    $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      start_date='';
      end_date='';
      $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
      $dTable.draw();
    });
  });
</script>
</body>
</html>
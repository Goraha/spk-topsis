<link rel="stylesheet" href="../../asset/css/bootstrap.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="../../datatables/datatables.min.css"/>
<script type="text/javascript" src="../../datatables/datatables.min.js"></script>
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

<div class="col-lg-12">
  <div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12" align="center">
    <h1><span class="fa fa-child"></span> Data Alternatif</h1>
    </div>
  </div>
  <div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12" align="right">
    <a class="btn btn-outline-primary" href="data_alternatif_tambah.php"
        style="float: right; margin-bottom: 25px;"><i class="fa fa-plus"></i> Tambah Data Alternatif</a>
    </div>
  </div>
  <div class="row" style="margin: 0px;">
    <div class="col-lg-12">
      <div class="form-group row">
        <div class="col-lg-6">
          
        </div>
        <div class="col-lg-2" align="right">
          <label class="col-sm-2 col-form-label"><b>Cari</b></label>
        </div>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="cr_kode" placeholder="Kode Anggota..." autocomplete="off">
        </div>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="cr_nama" placeholder="Nama Anggota..." autocomplete="off">
        </div>
      </div>
    </div>
  </div>
  
  <div class="row" style="margin: 0px;">
    <div class="table-responsive">
      <table id="example" class="table table-hover table-bordered data" style="font-size:12px;">
			<thead>
				<tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">			
					<th class="text-center">No</th>
                    <th class="text-center">Kode Alternatif</th>
					<th class="text-center">Nomor Buku Anggota</th>
					<th class="text-center">Nama Lengkap</th>
                    <?php
                        include "../include/data_kon.php";
                        $sql = $pdo->prepare("SELECT * FROM tbl_kriteria ");
                        $sql->execute();
                        while($data = $sql->fetch()){
                        $kd_kriteria_arr[] = $data['kd_kriteria'];
                    ?>
                        <th class="text-center"><?php echo $data['nm_kriteria']; ?></th>
                    <?php
                    }
                    ?>
                    <th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody>
        <?php
        include "../include/data_kon.php";
        $sql = $pdo->prepare("SELECT * FROM tbl_alternatif as a left join tbl_anggota as b on a.nba=b.nba ORDER BY a.kd_alternatif ASC");
        $sql->execute();
        $no = 1;
        while($data = $sql->fetch()){
        ?>
				<tr>				
          <td class="align-middle text-center"><b><?php echo $no; ?></b></td>
          <td class="align-middle text-center"><?php echo $data['kd_alternatif']; ?></td>
          <td class="align-middle text-center"><?php echo $data['nba']; ?></td>
          <td class="align-middle text-center"><?php echo $data['nm_lengkap']; ?></td>
          <?php
                $lim= count($kd_kriteria_arr);
                for ($i=0; $i < $lim; $i++) {
                    $kd_krit = $kd_kriteria_arr[$i];            
            ?>
                <td class="text-center  align-middle">
                <?php
                        include "../include/data_kon.php";
                        $sql3 = $pdo->prepare("SELECT * FROM tbl_nilai_alternatif left join tbl_subkriteria on tbl_nilai_alternatif.kd_subkriteria = tbl_subkriteria.kd_subkriteria left join tbl_kriteria on tbl_subkriteria.kd_kriteria = tbl_kriteria.kd_kriteria WHERE kd_alternatif='".$data['kd_alternatif']."' AND tbl_kriteria.kd_kriteria = '$kd_krit'");
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

          <td class="align-middle text-center" style="padding:0px;">
            <a class="btn btn-outline-success btn-sm"
              href='data_alternatif_ubah.php?kd_alternatif=<?php echo $data['kd_alternatif']; ?>' style="margin:0px;"><i
                class="fa fa-edit"></i> Ubah </a>
            <a class="btn btn-outline-danger btn-sm" id="tombol-hapus"
              href='data_alternatif_hapus.php?kd_alternatif=<?php echo $data['kd_alternatif']; ?>'
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
	$(document).ready(function(){
		$('.data').DataTable();

    
	});

  var stdTable = $('#example').DataTable({});

  $('#cr_kode').on('keyup', function () {
    stdTable
    .columns()
    .search('')
    .column(2)
        .search(this.value)
        .draw();
  });

  $('#cr_nama').on('keyup', function () {
    stdTable
    .columns()
    .search('')
    .column(3)
        .search(this.value)
        .draw();
  });
</script>
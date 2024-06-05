<link rel="stylesheet" href="../../asset/css/bootstrap.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>

<style>
  .aas {
    box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2);
  }

</style>
<div class="col-lg-12">
  <div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12" align="center">
    <h1><span class="fa fa-drivers-license"></span> Data Kriteria</h1>
    </div>
  </div>
  <div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12" align="right">
      <a id="tombol-tambah" class="btn btn-outline-primary" href="data_kriteria_tambah.php"
          style="float: right; margin-bottom: 25px;"><i class="fa fa-plus"></i> Tambah Data Kriteria</a>
    </div>
  </div>
</div>

<div class="col-lg-12" align="center">
  <div class="row" style="margin: 0px;">
    <div class="table-responsive" style="padding:20px;">
      <table class="table table-hover table-bordered">
        <thead>
          <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
            <th class="text-center">NO</th>
            <th class="text-center">KD Kriteria</th>
            <th class="text-center">Nama Kriteria</th>
            <th class="text-center">Atribut</th>
            <th class="text-center">Bobot</th>
            <th class="text-center" style="width: 16.66%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        include "../include/data_kon.php";
        $page = (isset($_GET['page']))? $_GET['page'] : 1;
        $limit = 20;
        $limit_start = ($page - 1) * $limit;
        $sql = $pdo->prepare("SELECT * FROM tbl_kriteria LIMIT ".$limit_start.",".$limit);
        $sql->execute();
        $no = $limit_start + 1;
        while($data = $sql->fetch()){
        ?>
        <tr>
          <td class="align-middle text-center"><b><?php echo $no; ?></b></td>
          <td class="text-center align-middle"><?php echo $data['kd_kriteria']; ?></td>
          <td class="text-center align-middle"><?php echo $data['nm_kriteria']; ?></td>
          <td class="text-center align-middle"><?php echo $data['atribut']; ?></td>
          <td class="text-center align-middle"><?php echo $data['bobot']; ?></td>
          <td class="text-center align-middle" style="padding:0px;">
            <a class="btn btn-outline-success btn-sm"
              href='data_kriteria_ubah.php?kd_kriteria=<?php echo $data['kd_kriteria']; ?>' style="margin:0px;"><i
                class="fa fa-edit"></i> Ubah </a>
            <a class="btn btn-outline-danger btn-sm" id="tombol-hapus"
              href='data_kriteria_hapus.php?kd_kriteria=<?php echo $data['kd_kriteria']; ?>'
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

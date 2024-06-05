<link rel="stylesheet" href="../../asset/css/bootstrap.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>

<style>
  .aas {
    box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2);
  }

  html {
    font-size: 12px;
  }
</style>

<div class="col-lg-12" align="center">
  <h1><span class="fa fa-users"></span> Data Nilai Alternatif</h1>
  <div class="row" style="margin: 0px;">
    <div class="table-responsive" style="padding:20px;">
      <table class="table table-hover table-bordered"
        style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
        <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
          <th class="text-center">NO</th>
          <th class="text-center">KD Alternatif</th>
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

          <th class="text-center" style="width: 16.66%">Aksi</th>
        </tr>
        <?php
        include "../include/data_kon.php";
        $page = (isset($_GET['page']))? $_GET['page'] : 1;
        $limit = 20;
        $limit_start = ($page - 1) * $limit;
        $sql2 = $pdo->prepare("SELECT * FROM tbl_alternatif LIMIT ".$limit_start.",".$limit);
        $sql2->execute();
        $no = $limit_start + 1;
        while($data2 = $sql2->fetch()){
          $kd_alternatif = $data2['kd_alternatif'];
        ?>
        <tr>
          <td class="align-middle text-center"><b><?php echo $no; ?></b></td>
          <td class="text-center align-middle"><?php echo $data2['kd_alternatif']; ?></td>
          <td class="text-center align-middle"><?php echo $data2['nm_lengkap']; ?></td>

            <?php
                $lim= count($kd_kriteria_arr);
                for ($i=0; $i < $lim; $i++) {
                    $kd_krit = $kd_kriteria_arr[$i];            
            ?>
                <td class="text-center  align-middle">
                <?php
                        include "../include/data_kon.php";
                        $sql3 = $pdo->prepare("SELECT * FROM tbl_nilai_alternatif left join tbl_subkriteria on tbl_nilai_alternatif.kd_subkriteria = tbl_subkriteria.kd_subkriteria left join tbl_kriteria on tbl_subkriteria.kd_kriteria = tbl_kriteria.kd_kriteria WHERE kd_alternatif='".$data2['kd_alternatif']."' AND tbl_kriteria.kd_kriteria = '$kd_krit'");
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





          <td class="text-center align-middle" style="padding:0px;">
            <a class="btn btn-success" href='data_nilai_alternatif_ubah.php?kd_alternatif=<?php echo $kd_alternatif; ?>' style="margin:0px;"><i class="fa fa-edit"></i> Ubah </a>
          </td>
        </tr>
        <?php
            $no++;
            }
          ?>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <!-- LINK FIRST AND PREV -->
          <?php
            if($page == 1){
          ?>
          <li class="page-item disabled"><a class="page-link" href="#">First</a></li>
          <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
          <?php
            }else{
            $link_prev = ($page > 1)? $page - 1 : 1;
          ?>
          <li class="page-item"><a class="page-link" href="data_nilai_alternatif.php?page=1">First</a></li>
          <li class="page-item"><a class="page-link"
              href="data_nilai_alternatif.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
          <?php
            }
          ?>
          <?php
            $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM tbl_alternatif");
            $sql2->execute();
            $get_jumlah = $sql2->fetch();
            $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
            $jumlah_number = 3;
            $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
            $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
            for($i = $start_number; $i <= $end_number; $i++){
              $link_active = ($page == $i)? ' class="page-item active"' : '';
          ?>
          <li <?php echo $link_active; ?>><a class="page-link"
              href="data_nilai_alternatif.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php
            }
          ?>
          <?php
            if($page == $jumlah_page){
          ?>
          <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
          <li class="page-item"><a class="page-link" href="#">Last</a></li>
          <?php
            }else{
              $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
          ?>
          <li class="page-item"><a class="page-link"
              href="data_nilai_alternatif.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
          <li class="page-item"><a class="page-link"
              href="data_nilai_alternatif.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
          <?php
            }
          ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

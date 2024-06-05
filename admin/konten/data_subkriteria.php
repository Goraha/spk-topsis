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
<div class="row">
    <div class="col-lg-12" align="center">
    <h1><span class="fa fa-drivers-license-o"></span> Data Subkriteria</h1>
    </div>

</div>
<div class="row">



    <?php
        include "../include/data_kon.php";
        $sql = $pdo->prepare("SELECT * FROM tbl_kriteria ");
        $sql->execute();
        while($data = $sql->fetch()){
        $kd_kriteria = $data['kd_kriteria'];
    ?>


    <div class="col-lg-4">
        <div class="table-responsive"  style="padding:5px;">
            <form method="post" action="" enctype="multipart/form-data">
                <table class="table table-hover table-bordered"
                    style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                    <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                        <th class="text-left align-center" colspan="2">Kriteria <?php echo $data['kd_kriteria'].'/'.$data['nm_kriteria'].' ('.$data['atribut'].')'; ?></th>
                        <th class="text-right align-center">
                        <a class="btn btn-secondary btn-sm"
                        href='data_subkriteria_tambah.php?kd_kriteria=<?php echo $data['kd_kriteria']; ?>'
                        ><i class="fa fa-plus"></i> Tambah Subkriteria</a>
                        </th>
                    </tr>
                    <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                        <th class="text-center">Nama Subkriteria</th>
                        <th class="text-center">Nilai</th>
                        <th class="text-center">Aksi</th>
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
                        <td class="text-center align-middle" style="padding:0px;">
                        
                        <a class="btn btn-outline-success btn-sm"
                        href='data_subkriteria_ubah.php?kd_subkriteria=<?php echo $data1['kd_subkriteria'].'&kd_kriteria='.$data['kd_kriteria']; ?>' style="margin:0px;"><i
                            class="fa fa-edit"></i> Ubah </a>
                        <a class="btn btn-outline-danger btn-sm" id="tombol-hapus"
                        href='data_subkriteria_hapus.php?kd_subkriteria=<?php echo $data1['kd_subkriteria'].'&kd_kriteria='.$data['kd_kriteria']; ?>'
                        style="margin:0px;"><i class="fa fa-close"></i> Hapus</a>
                        </td>
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



<?php

include "../include/koneksi.php";
IF(ISSET($_POST['simpan'])){
    $arr_kd = $_POST['kd_subkriteria'];
    $arr_nm = $_POST['nm_subkriteria'];
    for($i=0; $i < 5; $i++){
        $kd_subkriteria=$arr_kd[$i];
        $nm_subkriteria= $arr_nm[$i];
        
        $query = "UPDATE tbl_subkriteria SET nm_subkriteria='".$nm_subkriteria."' WHERE kd_subkriteria='".$kd_subkriteria."'";
        $sql = mysqli_query($connect, $query);
       // echo "<script language=\"javascript\">alert(\"$query\");</script>"; 
    }
        echo "<script language=\"javascript\">alert(\"Berhasil Mengubah Data\");document.location.href='data_subkriteria.php';</script>";
}
?>
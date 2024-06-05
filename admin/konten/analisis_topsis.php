<?php
    date_default_timezone_set('Asia/Jakarta');
    $tgl_kd_hasil = date("dmy");
    $tgl_skrg = date("yy-m-d");

    $kd_hasil="SPK-".$tgl_kd_hasil;
    include "../include/koneksi.php";
    $cek = mysqli_num_rows(mysqli_query($connect,"SELECT max(kd_hasil) as kd_hasil FROM tbl_hasil WHERE kd_hasil LIKE '%$kd_hasil%'"));
    
    IF($cek > 0){
        $data = mysqli_fetch_array(mysqli_query($connect,"SELECT max(kd_hasil) as kd_hasil FROM tbl_hasil WHERE kd_hasil LIKE '%$kd_hasil%'"));
        $no_urut= (int) substr($data['kd_hasil'], 9, 12);
        $no_urut++;
        $kd_hasil= "SPK-".$tgl_kd_hasil.sprintf("%03s", $no_urut);
    }else{
        $kd_hasil= "SPK-".$tgl_kd_hasil."001"; 
    }
?>

<link rel="stylesheet" href="../../asset/css/bootstrap.css">
<link rel="stylesheet" href="../../asset/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../../asset/css/font_style.css">

<script src="../../asset/js/jquery.js"></script>
<script src="../../asset/js/bootstrap.js"></script>
<script src="../../asset/js/moment.js"></script>
<script src="../../asset/js/bootstrap-datepicker.js"></script>

<style>
    .aas {
        box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2);
    }

    html {
        font-size: 12px;
    }

.modal-dialog{
   position:fixed;
   top:auto;
   right:30%;
   left:30%;
   bottom:20%;
}  
</style>

<div class=row>
    <div class="col-lg-12" align="center">
        <h1><i class="fa fa-line-chart"></i> Analisis TOPSIS</h1>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_k" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center">KD Kriteria</th>
                    <th class="text-center">Nama Kriteria</th>
                    <th class="text-center">Atribut</th>
                    <th class="text-center">Bobot</th>
                </tr>
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
                <tr>
                    <td class="text-center align-middle"><?php echo $data['kd_kriteria']; ?></td>
                    <td class="text-center align-middle"><?php echo $data['nm_kriteria']; ?></td>
                    <td class="text-center align-middle"><?php echo $data['atribut']; ?></td>
                    <td class="text-center align-middle"><?php echo $data['bobot']; ?></td>
                </tr>
                <?php
             $ttl_kriteria++;}
          ?>
            </table>
        </div>
    </div>
    <!-- data kosong -->
    <div class="col-lg-6">
        <div class="table-responsive" style="padding:20px;">
            <table class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center">KD Alternatif</th>
                    <th class="text-center">Nama Lengkap</th>
                    <?php
                        include "../include/data_kon.php";
                        $sql = $pdo->prepare("SELECT * FROM tbl_kriteria");
                        $sql->execute();
                        while($data = $sql->fetch()){
                        $kd_kriteria_arr[] = $data['kd_kriteria'];
                    ?>
                    <th class="text-center"><?php echo $data['nm_kriteria']; ?></th>
                    <?php
                        }
                    ?>
                </tr>
                <?php
                    include "../include/data_kon.php";
                    $sql2 = $pdo->prepare("SELECT * FROM tbl_alternatif as a left join tbl_anggota as b on a.kd_anggota=b.kd_anggota");
                    $sql2->execute();
                    while($data2 = $sql2->fetch()){
                ?>
                <tr>
                    <td class="text-center align-middle" style="padding:0px;"><?php echo $data2['kd_alternatif']; ?>
                    </td>
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

                </tr>
                <?php
                    }
                    unset($kd_kriteria_arr); 
                ?>
            </table>
        </div>
    </div>
    <!-- data kosong -->
    <div class="col-lg-6">
        <div class="table-responsive" style="padding:20px;">
            <table class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center">KD Alternatif</th>
                    <th class="text-center">Nama Lengkap</th>
<script type="text/javascript">
    var kd_kriteria = [];
    var nm_kriteria = [];
    var i=0;
    var data_kriteria = [];
    var data_alternatif = [];
</script>
                    <?php
                        include "../include/data_kon.php";
                        $ttl_kriteria=0;
                        $sql = $pdo->prepare("SELECT * FROM tbl_kriteria");
                        $sql->execute();
                        while($data = $sql->fetch()){
                        $kd_kriteria_arr[] = $data['kd_kriteria'];
                        $ttl_kriteria++;
                    ?>
<script type="text/javascript">
    kd_kriteria[i] = '<?php echo $data['kd_kriteria']; ?>';
    nm_kriteria[i] = "<?php echo $data['nm_kriteria']; ?>";
    i++;
    data_kriteria.push({ "kd_kriteria": "<?php echo $data['kd_kriteria']; ?>",
     "nm_kriteria": "<?php echo $data['nm_kriteria']; ?>" });
</script>
                    <th class="text-center"><?php echo $data['nm_kriteria']; ?></th>
                    <?php
                        }
                    ?>
                </tr>
                <?php
                    include "../include/data_kon.php";
                    $sql2 = $pdo->prepare("SELECT * FROM tbl_alternatif as a left join tbl_anggota as b on a.kd_anggota=b.kd_anggota");
                    $sql2->execute();
                    while($data2 = $sql2->fetch()){
                ?>

                <tr>
                    <td class="text-center align-middle" style="padding:0px;"><?php echo $data2['kd_alternatif']; ?>
                    </td>
                    <td class="text-center align-middle"><?php echo $data2['nm_lengkap']; ?></td>

                    <?php
                        $lim= count($kd_kriteria_arr);
                        $hh='';
                        for ($i=0; $i < $lim; $i++) {
                            $kd_krit = $kd_kriteria_arr[$i];            
                    ?>
                    <td class="text-center  align-middle">
                        <?php
                        include "../include/koneksi.php";
                        $query3 = "SELECT IF( EXISTS(
                            SELECT * FROM tbl_nilai_alternatif as a left join tbl_subkriteria as b on a.kd_subkriteria = b.kd_subkriteria left join tbl_kriteria as c on b.kd_kriteria = c.kd_kriteria WHERE kd_alternatif='".$data2['kd_alternatif']."' AND c.kd_kriteria = '$kd_krit'), (SELECT nilai  FROM tbl_nilai_alternatif left join tbl_subkriteria on tbl_nilai_alternatif.kd_subkriteria = tbl_subkriteria.kd_subkriteria left join tbl_kriteria on tbl_subkriteria.kd_kriteria = tbl_kriteria.kd_kriteria WHERE kd_alternatif='".$data2['kd_alternatif']."' AND tbl_kriteria.kd_kriteria = '$kd_krit'), 0) as nilai";
                        $sql3 = mysqli_query($connect, $query3);
                        $data3 = mysqli_fetch_array($sql3);
                        echo $data3['nilai'];
                        $a= $data3['nilai'];
                        $hh =$hh."\"$kd_krit\": \"$a\",";
                    ?>
                    </td>

                    <?php
                        }
                    ?>

                </tr>
                <script type="text/javascript">
  
    data_alternatif.push({ "kd_alternatif": "<?php echo $data2['kd_alternatif']; ?>",
                            "nm_alternatif": "<?php echo $data2['nm_lengkap']; ?>",
                            <?php echo $hh;?>
                        });               
</script>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_pembagi" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">

                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center" colspan="<?php echo json_encode($ttl_kriteria); ?>">Pembagi Alternatif</th>
                </tr>
                <tr id="judul_pembagi" style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    
                </tr>
                <tr id="pembagi">
                
                </tr>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        var tt =0;
        var k=0;
        var pembagi =0;
        var arr_pembagi=[];

        var tr = $('#judul_pembagi');
        for (var i = 0; i < kd_kriteria.length; i++) {//k1
            var str = '<th class="text-center">'+nm_kriteria[i]+'</th>';
            tr.append(str);
        }

        for (var i = 0; i < kd_kriteria.length; i++) {//k1
                
                for (var j = 0; j < data_alternatif.length; j++) {
                    k= parseInt(eval('data_alternatif[j]'+'.'+kd_kriteria[i]));
                    tt=(k*k)+tt;
                }

                pembagi = Math.sqrt(parseInt(tt)).toFixed(4);
                arr_pembagi.push(pembagi);
                //alert(pembagi);
                $('#pembagi').append('<td id="pembagi" class="text-center">'+pembagi+'</td>');
                tt=0;
                pembagi=0;
                
            }
    </script>

    <div class="col-lg-6">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_ternormalisasi" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">

                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center" colspan="<?php echo json_encode($ttl_kriteria)+2; ?>">Matriks Ternormalisasi</th>
                </tr>
                <tr id="judul_normalisasi" style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama Alternatif</th>
                </tr>
            </table>
        </div>
    </div>




<script type="text/javascript">

var arr_normalisasi=[];
var arr_bobot=[];

    var tr = $('#judul_normalisasi');
    for (var i = 0; i < kd_kriteria.length; i++) {//k1
        var str = '<th class="text-center">'+nm_kriteria[i]+'</th>';
        tr.append(str);
    }

//alert(data_alternatif.length);
var table = $('#tbl_ternormalisasi');

for (var x = 0; x < data_alternatif.length; x++) {
    var tr = '<tr>';
    tr += '<td class="text-center align-middle">'+data_alternatif[x].kd_alternatif+'</td>';
    tr += '<td class="text-center align-middle">'+data_alternatif[x].nm_alternatif+'</td>';

    for (var z = 0; z < kd_kriteria.length; z++){
        var sem = eval('data_alternatif[x]'+'.'+kd_kriteria[z]);
        sem = sem/arr_pembagi[z];
        sem = sem.toFixed(4);
        arr_normalisasi.push(sem);
        tr+="<td >"+sem + "</td>";
    }
    tr+="<tr>";
    table.append(tr);
}

</script>

    <div class="col-lg-6">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_terbobot" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center"colspan="<?php echo json_encode($ttl_kriteria)+2; ?>">Matriks Terbobot</th>
                </tr>
                <tr id="judul" style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama Alternatif</th>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
    var table = $('#tbl_terbobot');
    var tr = $('#judul');
    for (var i = 0; i < kd_kriteria.length; i++) {//k1
        var str = '<th class="text-center">'+nm_kriteria[i]+'</th>';
        tr.append(str);
    }
    var jj=0;
    for (var x = 0; x < data_alternatif.length; x++) {
    var tr = '<tr>';
    tr+='<td class="text-center align-middle">'+data_alternatif[x].kd_alternatif+'</td>';
    tr+='<td class="text-center align-middle">'+data_alternatif[x].nm_alternatif+'</td>';
        for (var z = 0; z < kd_kriteria.length; z++){
            var sem = eval('data_alternatif[x]'+'.'+kd_kriteria[z]);
            var ss = (arr_normalisasi[jj]*bobot_kriteria[z]).toFixed(4)
            tr+=`<td class="bobot_`+kd_kriteria[z]+`">`+ss+`</td>`;
            jj++;
        }
        tr+="<tr>";
        table.append(tr);
    }

    </script>


    <div class="col-lg-12">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_solusi" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center" colspan="<?php echo json_encode($ttl_kriteria)+1; ?>">matriks solusi ideal positif dan matriks solusi ideal nagatif</th>
                </tr>
                <tr id="judul_solusi" style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th>Keterangan</th>
                </tr>
                <tr id="max_solusi">
                    <td>MAX</td>
                </tr>
                <tr id="min_solusi">
                    <td>MIN</td>
                </tr>
            </table>
        </div>
    </div>

    <script type="text/javascript">
    var table = $('#tbl_terbobot');
    var tr = $('#judul_solusi');
    var tr_max = $('#max_solusi');
    var tr_min = $('#min_solusi');
    for (var i = 0; i < kd_kriteria.length; i++) {//k1
        var str = '<th class="text-center">'+nm_kriteria[i]+'</th>';
        tr.append(str);
    }
    
    
    for (var i = 0; i < kd_kriteria.length; i++) {
        var xxx="#tbl_terbobot .bobot_"+kd_kriteria[i];
        var ttl=0;
        var sem = [];
        $(xxx).each(function() {
            sem.push($(this).html());
        });
        //cari max
        if (atribut_kriteria[i]=='benefit') {
            ttl = Math.max(...sem).toFixed(4);
        }else{
            ttl = Math.min(...sem).toFixed(4);
        }

        var str = '<td class="max_'+kd_kriteria[i]+'">'+ttl+'</td>';
        tr_max.append(str);

        if (atribut_kriteria[i]=='benefit') {
            ttl = Math.min(...sem).toFixed(4);
        }else{
            ttl = Math.max(...sem).toFixed(4);
        }
        
        var str = '<td class="min_'+kd_kriteria[i]+'">'+ttl+'</td>';
        tr_min.append(str);
    }
    
    </script>


    <div class="col-lg-6">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_ideal" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center"  colspan="4">matriks solusi ideal positif dan matriks solusi ideal nagatif</th>
                </tr>
                <tr id="judul_ideal" style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <th>D+</th>
                    <th>D-</th>
                </tr>
            </table>
        </div>
    </div>


    <script type="text/javascript">
    var table = $('#tbl_ideal');
    
    var jj=0;
    for (var x = 0; x < data_alternatif.length; x++) {
    var str = `<tr id="`+data_alternatif[x].kd_alternatif+`">`;
    str+=`<td class="text-center align-middle">`+data_alternatif[x].kd_alternatif+`</td>`;
    str+=`<td class="text-center align-middle">`+data_alternatif[x].nm_alternatif+`</td>`;
        var ttlmax=0,ttlmin=0;
        for (var z = 0; z < kd_kriteria.length; z++){
            var q_max="#tbl_solusi .max_"+kd_kriteria[z];
            var q_min="#tbl_solusi .min_"+kd_kriteria[z];
            var sem_max,sem_min;
            $(q_max).each(function() {
                sem_max = $(this).html();
            });
            $(q_min).each(function() {
                sem_min = $(this).html();
            });
            var a = arr_normalisasi[jj]*bobot_kriteria[z];
            ttlmax=ttlmax + Math.pow(a-sem_max,2);
            ttlmin=ttlmin + Math.pow(a-sem_min,2);
            jj++;
        }
        str+=`<td class="ideal_max_`+kd_kriteria[x]+`_`+data_alternatif[x].kd_alternatif+`">`+Math.sqrt(ttlmax).toFixed(4)+`</td>`;
        str+=`<td class="ideal_min_`+kd_kriteria[x]+`_`+data_alternatif[x].kd_alternatif+`">`+Math.sqrt(ttlmin).toFixed(4)+`</td>`;

        str+="</tr>";
        table.append(str);
    }
    </script>




    <div class="col-lg-6">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_prefensi" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center" colspan="3">nilai preferensi untuk setiap alternatif</th>
                </tr>
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <th>Preferensi (V)</th>
                </tr>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        var data_hasil = [];
        var table = $('#tbl_prefensi');
        
        var jj=0;
        for (var x = 0; x < data_alternatif.length; x++) {
        var str = `<tr id="`+data_alternatif[x].kd_alternatif+`">`;
        str+= `<td class="text-center align-middle">`+data_alternatif[x].kd_alternatif+`</td>`;
        str+= `<td class="text-center align-middle">`+data_alternatif[x].nm_alternatif+`</td>`;
            var ttlmax=0,ttlmin=0;

            for (var z = 0; z < kd_kriteria.length; z++){
                var q_max="#tbl_ideal .ideal_max_"+kd_kriteria[z]+"_"+data_alternatif[x].kd_alternatif;
                var q_min="#tbl_ideal .ideal_min_"+kd_kriteria[z]+"_"+data_alternatif[x].kd_alternatif;
                var sem_max,sem_min;
                $(q_max).each(function() {
                    sem_max = $(this).html();
                    //alert(sem_max);
                });

                $(q_min).each(function() {
                    sem_min = $(this).html();
                    //alert(sem_max);
                });

                ttlmax=parseFloat(sem_min)/(parseFloat(sem_min)+parseFloat(sem_max));
                var gabs =ttlmax.toFixed(4);
                jj++;


            }
            data_hasil.push({"kd_alternatif":data_alternatif[x].kd_alternatif,
                             "nm_alternatif":data_alternatif[x].nm_alternatif,
                             "nilai_alternatif":ttlmax
            });
            str+=`<td>`+gabs+`</td>`;



            str+="</tr>";
            table.append(str);
        }
    </script>


    <div class="col-lg-12">
        <div class="table-responsive" style="padding:20px;">
            <table id="tbl_rank" class="table table-bordered"
                style="box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2); border-radius: 8px;">
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th class="text-center" colspan="4">Perangkingan</th>
                </tr>
                <tr style="background-image: linear-gradient(90deg, #5433FF, #20BDFF, #A5FECB);color: white;">
                    <th>Rank.</th>
                    <th>Kode Alternatif</th>
                    <th>Nama Alternatif</th>
                    <th>Nilai Akhir</th>
                </tr>
            </table>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Simpan Hasil</button>
        </div>
    </div>

    <script type="text/javascript">
        var table = $('#tbl_rank');
        data_hasil.sort(function(a, b) {
            return parseFloat(b.nilai_alternatif - parseFloat(a.nilai_alternatif));
        });

        var no=1;
        for (var z = 0; z < data_hasil.length; z++){
            
            var str = `<tr>`;
            str += `<td class="text-center align-middle">`+no+`</td>`;
            str += `<td class="text-center align-middle">`+data_hasil[z].kd_alternatif+`</td>`;
            str += `<td class="text-center align-middle">`+data_hasil[z].nm_alternatif+`</td>`;
            str += `<td class="text-center align-middle">`+data_hasil[z].nilai_alternatif.toFixed(4)+`</td>`;
            str+="</tr>";
            table.append(str);
            no++;
        }
    </script>

</div>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Simpan Hasil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div>
                                <input type="text" name="kd_hasil" value="<?php echo $kd_hasil; ?>" hidden>
                            </div>
                            <div id="input">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="left">
                                <label>Tanggal Simpan</label>
                                    <div id="sandbox-container">
                                    <input type="text" class="form-control" name="tgl_simpan" value="<?php echo $tgl_skrg; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="left">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                    </div>
                </>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-success"><span class="fa fa-save"></span>
              Simpan </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
        var div = $('#input');
        data_hasil.sort(function(a, b) {
            return parseFloat(b.nilai_alternatif - parseFloat(a.nilai_alternatif));
        });

        var no=1;
        for (var z = 0; z < data_hasil.length; z++){
            var str =``;
            str +=`<input type="text" name="kd_alternatif[]" value="`+data_hasil[z].kd_alternatif+`" hidden>`;
            str +=`<input type="text" name="nm_alternatif[]" value="`+data_hasil[z].nm_alternatif+`" hidden>`;
            str +=`<input type="text" name="nilai_alternatif[]" value="`+data_hasil[z].nilai_alternatif.toFixed(4)+`" hidden>`;
            div.append(str);
            no++;
        }
    </script>







<script type="text/javascript">
$('#sandbox-container input').datepicker({
  format: 'yyyy-mm-dd',
});
</script>




<?php
include "../include/koneksi.php";
IF(ISSET($_POST['simpan'])){
    $kd_hasil = $_POST['kd_hasil'];
    $tgl_simpan = $_POST['tgl_simpan'];
    $keterangan = $_POST['keterangan'];
    $kd_alternatif = $_POST['kd_alternatif'];
    $nm_alternatif = $_POST['nm_alternatif'];
    $nilai_alternatif = $_POST['nilai_alternatif'];


    $query = "INSERT INTO tbl_hasil VALUES('$kd_hasil','$tgl_simpan','$keterangan')";
    $sql = mysqli_query($connect, $query);
    if($sql){
        $n = count($kd_alternatif);
        for($g=0; $g < $n; $g++){
            $query = "INSERT INTO tbl_hasil_detail VALUES('','$kd_hasil','$kd_alternatif[$g]','$nm_alternatif[$g]','$nilai_alternatif[$g]')";
            $sql = mysqli_query($connect, $query);
            
        }
        echo "<script language=\"javascript\">alert(\"Berhasil Menyimpan Data\");document.location.href='analisis_topsis.php';</script>";
    }else{
        echo "<script language=\"javascript\">alert(\"Gagal Menyimpan Data\");document.location.href='analisis_topsis.php';</script>";
    }
}
?>
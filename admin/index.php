<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Beranda">
    <meta name="author" content="">
    <title>SPK | CUM Caritas HKBP </title>
    <link rel="shortcut icon" href="../asset/img/min-logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="../asset/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../asset/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="../asset/css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light border-bottom shadow-lg">
    <a class="navbar-brand" href="#">
    <img src="../asset/img/min-logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
  </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link"  href="konten/beranda.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-home"></i> Beranda <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link"  href="konten/data_anggota.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-users"></i> Data Anggota <span class="sr-only"></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> 
                        Olah Data SPK
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="nav-link" href="konten/data_kriteria.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-angle-right"></i> Data Kriteria <span class="sr-only"></span></a>
                    <a class="nav-link" href="konten/data_subkriteria.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-angle-right"></i> Data Subkriteria <span class="sr-only"></span></a>
                    <a class="nav-link" href="konten/data_alternatif.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-angle-right"></i> Data Alternatif <span class="sr-only"></span></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-line-chart"></i> 
                        Perhitungan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="nav-link" href="konten/perhitungan.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-angle-right"></i> Generete <span class="sr-only"></span></a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="konten/data_hasil.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-book"></i> Daftar Hasil <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="konten/data_hasil.php" target="konten" onClick = "document.getElementById('konten').style.height = '500px';"><i class="fa fa-user"></i> Akun <span class="sr-only"></span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a>
                </li>
            </ul>

        </div>
    </nav>

    <main role="main">
        <iframe name="konten" id="konten" src="konten/beranda.php" frameborder="0" scrolling="no" style="width: 100%;"
            onload="resizeIframe(this)">

        </iframe>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../asset/js/jquery.js"></script>
    <script src="../asset/js/popper.min.js"></script>
    <script src="../asset/js/bootstrap.js"></script>
    <script> 
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
        }
    </script>
</body>

</html>

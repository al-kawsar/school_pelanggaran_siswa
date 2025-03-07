<?php date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d');
require '../php/config.php';
require '../php/function.php';
session_start();
if (empty($_SESSION['c_admin'])) {
  header('location:../login');
}
$na = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM admin where c_admin='$_SESSION[c_admin]' ")); //$setting=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM setting limit 1 ")); 
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin SIMANIS</title>
  <link rel="icon" href="php/img/smansarImg.png">
  <link rel="shortcut icon" href="<?php echo $base; ?>php/img/smansarImg.png">
  <script type="text/javascript" src="<?php echo $basead; ?>js/jquery.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $base; ?>theme/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $base; ?>theme/plugins/datatables/dataTables.bootstrap.css">
  <!-- jvectormap -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $base; ?>theme/dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
       <!-- <link rel="stylesheet" href="<?php echo $base; ?>theme/dist/css/skins/_all-skins.min.css"> -->
       <link rel="stylesheet" href="<?php echo $base; ?>php/css/main.css">
       <link rel="stylesheet" href="<?php echo $base; ?>theme/plugins/iCheck/square/blue.css">
       <script type="text/javascript">
        $(document).ready(function() {
          $("#cari").keyup(function() {
            $("#fbody").find("tr").hide();
            var data = this.value.split("");
            var jo = $("#fbody").find("tr");
            $.each(data, function(i, v) {
              jo = jo.filter("*:contains('" + v + "')");
            });
            jo.fadeIn();

          })
        });
      </script>
      <!-- Pace style -->
      <link rel="stylesheet" href="<?php echo $base; ?>theme/plugins/pace/pace.min.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="<?php echo $base; ?>theme/plugins/select2/select2.min.css">

      <!-- datetime -->

      <link href="<?php echo $base; ?>theme/datetime/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style type="text/css">
      body {
        font-family: arial;
      }

      .judul {
        width: 100%;
        background-color: #FFF;
        padding: 10px;
        margin-bottom: 10px;
      }
    </style>
  </head>

  <body class="skin-green hold-transition fixed" oncontextmenu="return false">
    <!--modal ganti foto-->

    <script src="<?php echo $base; ?>php/olahangka.js"></script>
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>AKH</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>TATA TERTIB</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="glyphicon glyphicon-th" data-toggle="offcanvas" role="button" style="color: #fff;margin-top: 15px;margin-left: 15px;font-size: 15px;"> Menu
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

            <?php /*if(empty($_GET['thisaction']) or $_GET['thisaction']!='grafik'){ ?>
          <li>
            <a href="<?php echo $basead; ?>a-control/<?php echo md5('testtoken').'/'.$t1=md5(date('H:i:s')); ?>"><i class="glyphicon glyphicon-stats"></i> Test Token</a>
          </li>
          <li>
            <a href="<?php echo $basecon; ?>grafik"><i class="glyphicon glyphicon-stats"></i> Grafik</a>
          </li>
        <?php } else{?>
          <li class="active">
            <a href="<?php echo $basecon; ?>grafik"><i class="glyphicon glyphicon-stats"></i> Grafik</a>
          </li>
        <?php }*/ ?>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-search"></i> Cari Siswa
          </a>
          <ul class="dropdown-menu" style="border-bottom: 2px solid#aaa;">
            <li class="header text-center">Masukkan NISN Atau NAMA Siswa</li>
            <li>
              <form action="<?php echo $basead; ?>kesearch" method="get">
                <ul class="menu">
                  <li>
                    <input autofocus="" autocomplete="off" required="" type="text" name="search" class="form-control" style="margin-left:5%;width:90%;">
                  </li>
                </ul>
              </li>
              <li class="footer text-center" style="padding:10px;"><button class="btn btn-primary btn-sm btn-flat" style="width:96%;">Mulai Mencari...</button></li>
            </form>
          </ul>
        </li>

        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo $base; ?>php/img/smansarImg.png" class="user-image" alt="User Image">
            <span class="hidden-xs "><?php echo $na['nama'] ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo $base; ?>php/img/smansarImg.png" class="img-circle" alt="User Image">
              <p>
                <?php echo $na['nama']; ?>
                <small></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="<?php echo $base; ?>php/<?php echo md5('logout'); ?>" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-off"></i> Sign out</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $base; ?>php/img/smansarImg.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p class="text-black"><?php echo $na['nama']; ?></p>
        <p class="text-black"><?php echo tgl(date('d-m-Y')); ?></p>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">

    </form>
        <?php //navigasi aktif
        if (empty($_GET['smkakh'])) {
          $aak = 'class="active"';
          $bak = '';
          $cak = '';
          $drop1 = '';
          $drop2 = '';
          $drop3 = '';
          $dak = '';
          $eak = '';
          $fak = '';
          $gak = '';
        } else {
          $act = ($_GET['smkakh']);
          if ($act == 'kategoripelanggaran' or $act == 'bentukpelanggaran' or $act == 'addbentukpelanggaran' or $act == 'sanksipelanggaran' or $act == 'addsanksi' or $act == 'editsanksi') {
            $aak = '';
            $bak = 'class="active"';
            $cak = '';
            $dak = '';
            $eak = '';
            $fak = '';
            $gak = '';
            if ($act == 'kategoripelanggaran') {
              $drop1 = 'class="active"';
              $drop2 = '';
              $drop3 = '';
            } else if ($act == 'bentukpelanggaran' or $act == 'addbentukpelanggaran') {
              $drop1 = '';
              $drop2 = 'class="active"';
              $drop3 = '';
            } else if ($act == 'sanksipelanggaran' or $act == 'addsanksi' or $act == 'editsanksi') {
              $drop1 = '';
              $drop2 = '';
              $drop3 = 'class="active"';
            }
          } else if ($act == 'kelas') {
            $aak = '';
            $bak = '';
            $cak = 'class="active"';
            $dak = '';
            $eak = '';
            $fak = '';
            $gak = '';
            $drop1 = '';
            $drop2 = '';
            $drop3 = '';
          } else if ($act == 'siswa' or $act == 'addsiswa' or $act == 'editsiswa') {
            $aak = '';
            $bak = '';
            $cak = '';
            $dak = 'class="active"';
            $eak = '';
            $fak = '';
            $gak = '';
            $drop1 = '';
            $drop2 = '';
            $drop3 = '';
          } else if ($act == 'guru' or $act == 'addguru' or $act == 'editguru') {
            $aak = '';
            $bak = '';
            $cak = '';
            $dak = '';
            $eak = 'class="active"';
            $fak = '';
            $gak = '';
            $drop1 = '';
            $drop2 = '';
            $drop3 = '';
          } else if ($act == 'orangtua' or $act == 'walimurid') {
            $aak = '';
            $bak = '';
            $cak = '';
            $dak = '';
            $eak = '';
            $fak = 'class="active"';
            $gak = '';
            $drop1 = '';
            $drop2 = '';
            $drop3 = '';
          } else if ($act == 'pelanggaransiswa' or $act == 'lihatpelanggaransiswa') {
            $aak = '';
            $bak = '';
            $cak = '';
            $dak = '';
            $eak = '';
            $fak = '';
            $gak = 'class="active"';
            $drop1 = '';
            $drop2 = '';
            $drop3 = '';
          } else {
            $aak = '';
            $bak = '';
            $cak = '';
            $dak = '';
            $eak = '';
            $fak = '';
            $gak = '';
            $drop1 = '';
            $drop2 = '';
            $drop3 = '';
          }
        }
        //akhir navigasi aktif
        ?>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header text-center text-black">MAIN NAVIGATION</li>
          <li <?php echo $aak; ?>>
            <a href="<?php echo $basead; ?>">
              <i class="glyphicon glyphicon-th text-black "></i> <span class="text-black">Dashboard</span>
            </a>
          </li>
          <li <?php echo $bak; ?>>
            <a href="#">
              <i class="glyphicon glyphicon-menu-hamburger text-black"></i>
              <span class="text-black">Data Tata Tertib</span>
            </a>
            <ul class="treeview-menu text-black">
              <li class="text-navy" <?php echo $drop1; ?>><a href="<?php echo $basead; ?>kategoripelanggaran" class="text-navy"><i class="glyphicon glyphicon-education text-navy"></i> Kategori Pelanggaran</a></li>
              <li <?php echo $drop2; ?>><a href="<?php echo $basead; ?>bentukpelanggaran" class="text-navy"><i class="glyphicon glyphicon-education text-navy"></i> Bentuk Pelanggaran</a></li>
              <li <?php echo $drop3; ?>><a href="<?php echo $basead; ?>sanksipelanggaran" class="text-navy"><i class="glyphicon glyphicon-education text-navy"></i> Sanksi Pelanggaran</a></li>
            </ul>
          </li>
          <li <?php echo $gak; ?>>
            <a href="<?php echo $basead; ?>pelanggaransiswa">
              <i class="glyphicon glyphicon-remove-circle text-black"></i> <span class="text-black">Pelanggaran Siswa</span>
            </a>
          </li>

          <li <?php echo $cak; ?>>
            <a href="<?php echo $basead; ?>kelas">
              <i class="glyphicon glyphicon-tags text-black"></i> <span class="text-black">Kelas</span>
            </a>
          </li>
          <li <?php echo $dak; ?>>
            <a href="<?php echo $basead; ?>siswa">
              <i class="glyphicon glyphicon-education text-black"></i> <span class="text-black">Siswa</span>
            </a>
          </li>
          <li <?php echo $eak; ?>>
            <a href="<?php echo $basead; ?>guru">
              <i class="glyphicon glyphicon-blackboard text-black"></i> <span class="text-black">Guru BK</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">

      </section>

      <!-- Main content -->
      <section class="content">

        <?php
        if (empty($_GET['smkakh'])) {
          require 'view/home.php';
        } else {
          $act = ($_GET['smkakh']);
          if ($act == 'kategoripelanggaran') {
            require 'view/a-jenispel.php';
          } else if ($act == 'bentukpelanggaran') {
            require 'view/a-bentukpel.php';
          } else if ($act == 'addbentukpelanggaran') {
            require 'view/a-addbenpel.php';
          } else if ($act == 'sanksipelanggaran') {
            require 'view/a-sanksipel.php';
          } else if ($act == 'addsanksi') {
            require 'view/a-addsanksi.php';
          } else if ($act == 'editsanksi') {
            require 'view/a-editsanksi.php';
          } else if ($act == 'editsanksi') {
            require 'view/a-editsanksi.php';
          } else if ($act == 'kelas') {
            require 'view/a-kelas.php';
          } else if ($act == 'siswa') {
            require 'view/a-siswa.php';
          } else if ($act == 'addsiswa') {
            require 'view/a-addsiswa.php';
          } else if ($act == 'editsiswa') {
            require 'view/a-editsiswa.php';
          } else if ($act == 'guru') {
            require 'view/a-guru.php';
          } else if ($act == 'addguru') {
            require 'view/a-addguru.php';
          } else if ($act == 'editguru') {
            require 'view/a-editguru.php';
          } else if ($act == 'orangtua') {
            require 'view/a-orangtua.php';
          } else if ($act == 'walimurid') {
            require 'view/a-walimurid.php';
          } else if ($act == 'pelanggaransiswa') {
            require 'view/a-pelsiswa.php';
          } else if ($act == 'lihatpelanggaransiswa') {
            require 'view/a-detpelsiswa.php';
          } else if ($act == 'search') {
            require 'view/search.php';
          } else {
            require 'view/404.php';
          }
        }
        ?>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">

    <strong>Copyright &copy; 2024 <a href="#">SMKN 7 MAKASSAR (Tlp. (90111) 04113618198 )</a></strong><a href="https://www.instagram.com/_alkawsar/" target="_blank"> by Andi Muh Raihan Alkawsar </a>
  </footer>
  <!-- Control Sidebar -->


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

     </div>
     <!-- ./wrapper -->

     <!-- jQuery 2.2.3 -->
     <script src="<?php echo $base; ?>theme/plugins/jQuery/jquery-2.2.3.min.js"></script>
     <!-- Bootstrap 3.3.6 -->
     <script src="<?php echo $base; ?>theme/bootstrap/js/bootstrap.min.js"></script>
     <!-- DataTables -->
     <script src="<?php echo $base; ?>theme/plugins/datatables/jquery.dataTables.min.js"></script>
     <script src="<?php echo $base; ?>theme/plugins/datatables/dataTables.bootstrap.min.js"></script>
     <!-- SlimScroll -->
     <script src="<?php echo $base; ?>theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.0/jquery.slimscroll.js" integrity="sha512-JJRHKCeGUHYnHLUbgzLOq4sPDm8U1fYEV4zce1Xc/pqXSnjw3SSjzO1z9ADZhAcREr/XZf+XsF9aAbHmrYe0BA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
     <!-- FastClick -->
     <script src="<?php echo $base; ?>theme/plugins/fastclick/fastclick.js"></script>
     <!-- Sparkline -->
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js" integrity="sha512-/F8GvcdSUiYuL8wFMLRspx/PemIOOZBMiro7M9Wwn9V/wfzIH+RwIauASTQdJqaaZdSHBP4lmtq6VH5bbTNaJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
     <script src="<?php echo $base; ?>theme/plugins/sparkline/jquery.sparkline.min.js"></script>


     <!-- jvectormap -->
     <!-- SlimScroll 1.3.0 -->
     <script src="<?php echo $base; ?>theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.0/jquery.slimscroll.js" integrity="sha512-JJRHKCeGUHYnHLUbgzLOq4sPDm8U1fYEV4zce1Xc/pqXSnjw3SSjzO1z9ADZhAcREr/XZf+XsF9aAbHmrYe0BA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
     <!-- ChartJS 1.0.1 -->
     <!-- AdminLTE App -->
     <script src="<?php echo $base; ?>theme/dist/js/app.min.js"></script>
     <!-- AdminLTE for demo purposes -->
     <script src="<?php echo $base; ?>theme/dist/js/demo.js"></script>
     <script>
      $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": false,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
        $('#example3').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
      });
    </script>
    <script src="<?php echo $base; ?>theme/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function() {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
      });
    </script>
    <script src="<?php echo $base; ?>theme/plugins/pace/pace.min.js"></script>
    <script type="text/javascript">
    // To make Pace works on Ajax calls
      $(document).ajaxStart(function() {
        Pace.restart();
      });
      $('.ajax').click(function() {
        $.ajax({
          url: '#',
          primary: function(result) {
            $('.ajax-content').html('<hr>Ajax Request Completed !');
          }
        });
      });
    </script>
    <!-- Select2 -->
    <script src="<?php echo $base; ?>theme/plugins/select2/select2.full.min.js"></script>
    <script>
      $(function() {
      //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
    <script>
    //angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
      $(document).ready(function() {
        setTimeout(function() {
          $(".alert").fadeIn('fast');
        }, 100);
      });
    //angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
      setTimeout(function() {
        $(".alert").fadeOut('fast');
      }, 7000);
    </script>
  </body>

  </html>
<?php
if (isset($_GET['q'])) {
  $s = str_replace("_", " ", $_GET['q']);
} else {
  $s = '@';
}

// Mengambil data siswa berdasarkan NISN atau nama
$sea_query = mysqli_query($con, "SELECT * FROM siswa WHERE nisn='$s' OR nama LIKE '%$s%'");
$sea = null;
$kelas = null;
$pel = 0;
$totalpel = ['total' => 0];

if ($sea_query && mysqli_num_rows($sea_query) > 0) {
  $sea = mysqli_fetch_array($sea_query);

  // Mengambil data kelas siswa
  $kelas_query = mysqli_query($con, "SELECT * FROM kelas WHERE c_kelas='" . $sea['c_kelas'] . "'");
  if ($kelas_query && mysqli_num_rows($kelas_query) > 0) {
    $kelas = mysqli_fetch_array($kelas_query);
  }

  // Menghitung jumlah pelanggaran siswa
  $pel_query = mysqli_query($con, "SELECT * FROM pelanggaran WHERE c_siswa='" . $sea['c_siswa'] . "'");
  if ($pel_query) {
    $pel = mysqli_num_rows($pel_query);
  }

  // Menghitung total bobot pelanggaran siswa
  $totalpel_query = mysqli_query($con, "SELECT SUM(bobot) AS total FROM pelanggaran WHERE c_siswa='" . $sea['c_siswa'] . "'");
  if ($totalpel_query && mysqli_num_rows($totalpel_query) > 0) {
    $totalpel = mysqli_fetch_array($totalpel_query);
  }
} else {
  $sea = null;
}

if ($sea == null) {
  echo '<div class="alert alert-danger">Data tidak ditemukan</div>';
  echo '<button onclick="goBack()" class="btn btn-primary">Kembali</button>';
  // Berhenti eksekusi kode lebih lanjut
  echo '<script>
  function goBack() {
    window.history.back();
  }
  </script>';
  exit();
}
?>


<!-- Detail data siswa yang akan ditampilkan hanya jika data ditemukan -->
<div class="judul">Detail Pelanggaran Siswa <?php echo $s; ?></div>


<div class="row">
  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-blue">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo $base; ?>php/img/ortu.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h4 class="widget-user-username" style="font-size: 20px; font-weight:bold;"><?php echo $sea['nama']; ?></h4>
        <h5 class="widget-user-desc"><?php echo $kelas['kelas']; ?></h5>
        <h5 class="widget-user-desc"><?php echo $sea['alamat'] . ', ' . tgl($sea['tl']); ?></h5>
        <h5 class="widget-user-desc"><?php if ($sea['jk'] == 'L') {
          echo 'Laki - Laki';
        } elseif ($sea['jk'] == 'P') {
          echo 'Perempuan';
        } ?></h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <li><a>Total Pelanggaran <span style="font-size: 20px;margin-top:-3px;color: #428bca;" class="pull-right"><?php echo $pel; ?></span></a></li>
          <li><a>Poin Pelanggaran <span style="font-size: 20px;margin-top:-3px;color: #d9534f;" class="pull-right">
            <?php echo ($totalpel['total'] > 0) ? $totalpel['total'] : "0"; ?></span></a></li>
            <?php if ($totalpel['total'] >= 50) { ?>
              <li>
                <div style="margin-top: 20px; ">
                  <div class=" text-center">
                    <button class="btn bg-navy shadow-sm" style="margin-right: 10px;" onclick="printSurat()">
                      <i class="glyphicon glyphicon-print"></i> Print Pelanggaran
                    </button>
                    <button class="btn bg-navy shadow-sm" onclick="printSurat1()">
                      <i class="glyphicon glyphicon-print"></i> Cetak Surat
                    </button>
                  </div>
                </li>
              </li>
              <br>
            <?php } ?>
          </ul>
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
    <div class="col-xs-12 col-md-8 col-lg-8">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">&nbsp;Pelanggaran <?php echo $sea['nama'] ?></h3>
        </div>
        <div class="box-body">
          <table id="example3" class="table table-hover">
            <thead>
              <tr><b>
                <td>NO</td>
                <td>PELANGGARAN</td>
                <td>P</td>
                <td>OLEH</td>
              </b>
              <td>PADA</td>
            </tr>
          </thead>
          <tbody>
            <?php $smk = mysqli_query($con, "SELECT * FROM pelanggaran where c_siswa='$sea[c_siswa]' order by at desc ");
            $vr = 1;
            while ($akh = mysqli_fetch_array($smk)) {
              $gur = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM guru where c_guru='$akh[c_guru]' "));
              $ben = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM benpel where c_benpel='$akh[c_benpel]' "));
              ?>
              <tr>
                <td><?php echo $vr; ?></td>
                <td><?php echo $ben['benpel']; ?></td>
                <td><?php echo $ben['bobot']; ?></td>
                <td><?php echo $gur['nama']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($akh['at'])); ?></td>
              </tr>
              <?php $vr++;
            } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </dsiv>
  </div>
</div>


<!-- Template Surat Teguran Siswa untuk BK style="display: none; -->
<div id="surat" style="display: none;">

  <head>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      .header {
        background-color: #3498db;
        color: white;
        text-align: center;
        padding: 20px;
      }

      .header img {
        width: 100px;
        height: 100px;
        vertical-align: middle;
      }

      .header h1 {
        display: inline-block;
        margin: 0;
        padding: 0;
        font-size: 24px;
        vertical-align: middle;
      }

      .header .logo-left {
        float: left;
        margin-right: 10px;
      }

      .header .logo-right {
        float: right;
        margin-left: 10px;
      }

      .header p {
        margin: 5px 0;
      }
    </style>

  </head>

  <body>

    <div class="header">
      <img src="<?php echo $base; ?>php/img/ntbLogo.png" alt="Logo Kiri" class="logo-left ">
      <h1>PEMERINTAH PROVINSI SULAWESI SELATAN <br>DINAS PENDIDIKAN DAN KEBUDAYAAN <br class="mt-2"> <b>SMK NEGERI 7 MAKASSAR </b> <br>
        <p style="font-size: 16px;">NPSN : 40307386 Akreditasi : B</p>
      </h1>
      <img src="<?php echo $base; ?>php/img/smansarImg.png" alt="Logo Kanan" class="logo-right">
      <p>Jalan: Ince Nurdin No. 35, Kec. Ujung Pandang. Kota Makassar, Prov. Sulawesi Selatan, Kode pos 90111 <br>Email : smk7makassar35@ymail.com Web : smk7makassar.sch.id Telp. (90111) 04113618198</p>
      <hr />

      <center>
        <h3 style="margin-bottom: 10px;">LAPORAN PELANGGARAN SISWA</h3>
      </center>
    </div>

    <div style="margin-left: 20px;">
      <table style="border: none; width: 60%;">
        <tr>
          <td style="padding-right: 1px;">Nis</td>
          <td>:</td>
          <td><?php echo $sea['nisn']; ?></td>
        </tr>
        <tr>
          <td style="padding-right: 1px;">Nama Siswa</td>
          <td>:</td>
          <td><?php echo $sea['nama']; ?></td>
        </tr>
        <tr>
          <td style="padding-right: 1px;">Kelas</td>
          <td>:</td>
          <td><?php echo $kelas['kelas']; ?></td>
        </tr>
        <tr>
          <td style="padding-right: 1px;">Hal</td>
          <td>:</td>
          <td>Surat Teguran Pelanggaran yang dilakukan</td>
        </tr>
      </table>
    </div>


    <!-- Tabel Pelanggaran -->
    <center>
      <table style="border-collapse: collapse; margin-top: 20px; border: 1px solid #000;">
        <thead>
          <tr>
            <th style="border: 1px solid #000; padding: 8px;">No</th>
            <th class="text-center" style="border: 1px solid #000; padding: 8px;">Jenis Pelanggaran</th>
            <th class="text-center" style="border: 1px solid #000; padding: 8px;">Poin Pelanggaran</th>
            <th class="text-center" style="border: 1px solid #000; padding: 8px;">Guru yang Menangani</th>
            <th class="text-center" style="border: 1px solid #000; padding: 8px;">Tanggal Pelanggaran</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $smk = mysqli_query($con, "SELECT * FROM pelanggaran where c_siswa='$sea[c_siswa]' order by at desc ");
          $vr = 1;
          while ($akh = mysqli_fetch_array($smk)) {
            $gur = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM guru where c_guru='$akh[c_guru]' "));
            $ben = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM benpel where c_benpel='$akh[c_benpel]' "));
            ?>
            <tr>
              <td class="text-center" style="border: 1px solid #000; padding: 8px;"><?php echo $vr; ?></td>
              <td class="text-center" style="border: 1px solid #000; padding: 8px;"><?php echo $ben['benpel']; ?></td>
              <td class="text-center" style="border: 1px solid #000; padding: 8px;"><?php echo $ben['bobot']; ?></td>
              <td class="text-center" style="border: 1px solid #000; padding: 8px;"><?php echo $gur['nama']; ?></td>
              <td class="text-center" style="border: 1px solid #000; padding: 8px;"><?php echo date("d/m/Y", strtotime($akh['at'])); ?></td>
            </tr>
            <?php
            $vr++;
          }
          ?>
        </tbody>
      </table>
    </center>
    <br>
    <br>

    <div>
      <table border="1px" width="100%">
        <tr>
          <td align="left" valign="top">
            <strong style="margin-left: 20px;">Catatan:</strong>
            <p>.......................................................................................................................................................................................................</p>
            <p>.......................................................................................................................................................................................................</p>
            <p>.......................................................................................................................................................................................................</p>
            <div style="text-align: right; margin-right: 20px;">
              SMKN 7 Makassar, <?php echo tgl(date('d-m-Y')); ?>
              <br />
              Waka Kesiswaan <br />
              <br />
              <br />
              <br />
              <u>Irmawati Laesa</u>
              <br />
              NIP. 196705112003122002
            </div>
          </td>
        </tr>
      </table>
    </div>
  </body>

</div>


<!-- Template Surat Teguran Siswa untuk BK style="display: none; -->
<div id="printsurat" style="display: none;">

  <head>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      .header {
        background-color: #3498db;
        color: white;
        text-align: center;
        padding: 20px;
      }

      .header img {
        width: 100px;
        height: 100px;
        vertical-align: middle;
      }

      .header h1 {
        display: inline-block;
        margin: 0;
        padding: 0;
        font-size: 24px;
        vertical-align: middle;
      }

      .header .logo-left {
        float: left;
        margin-right: 10px;
      }

      .header .logo-right {
        float: right;
        margin-left: 10px;
      }

      .header p {
        margin: 5px 0;
      }
    </style>

  </head>

  <body>

    <body>
      <div class="header">
        <img src="<?php echo $base; ?>php/img/ntbLogo.png" alt="Logo Kiri" class="logo-left">
        <h1>PEMERINTAH PROVINSI SULAWESI SELATAN <br>DINAS PENDIDIKAN DAN KEBUDAYAAN <br class="mt-2"> <b>SMK NEGERI 7 MAKASSAR </b> <br>
          <p style="font-size: 16px;">NPSN : 40307386 Akreditasi : B</p>
        </h1>
        <img src="<?php echo $base; ?>php/img/smansarImg.png" alt="Logo Kanan" class="logo-right">
        <p>Jalan: Ince Nurdin No. 35, Kec. Ujung Pandang. Kota Makassar, Prov. Sulawesi Selatan, Kode pos 90111 <br>Email : smk7makassar35@ymail.com Web : smk7makassar.sch.id Telp. (90111) 04113618198</p>
        <hr />
        <center>
          <h3 style="margin-bottom: 10px;">SURAT PEMANGGILAN ORANG TUA</h3>
        </center>
      </div>

      <div style="margin-left: 20px;">
        <p>Nomor: ....../SMK-7/SKAVEN/....</p>
        <p>Lampiran: -</p>
        <p>Perihal: Pemanggilan Orang Tua/Wali</p>
        <br>
        <p>Yth. Orang Tua/Wali</p>
        <p>Di tempat</p>
        <br>
        <p>Dengan hormat,</p>
        <p>Berdasarkan catatan kami, siswa atas nama:</p>
        <table style="border: none; width: 60%;">
          <tr>
            <td style="padding-right: 1px;">Nama</td>
            <td>:</td>
            <td><?php echo $sea['nama']; ?></td>
          </tr>
          <tr>
            <td style="padding-right: 1px;">Kelas</td>
            <td>:</td>
            <td><?php echo $kelas['kelas']; ?></td>
          </tr>
          <tr>
            <td style="padding-right: 1px;">NISN</td>
            <td>:</td>
            <td><?php echo $sea['nisn']; ?></td>
          </tr>
        </table>
        <p>telah melakukan pelanggaran tata tertib dengan akumulasi poin pelanggaran sebesar <strong><?php echo $totalpel['total']; ?></strong> poin.</p>
        <p>Sehubungan dengan hal tersebut, kami mengundang Bapak/Ibu untuk hadir ke sekolah pada:</p>
        <table style="border: none; width: 60%;">
          <tr>
            <td style="padding-right: 1px;">Hari/Tanggal</td>
            <td>:</td>
            <td>..............................................</td>
          </tr>
          <tr>
            <td style="padding-right: 1px;">Waktu</td>
            <td>:</td>
            <td>..............................................</td>
          </tr>
          <tr>
            <td style="padding-right: 1px;">Tempat</td>
            <td>:</td>
            <td>..............................................</td>
          </tr>
        </table>
        <p>Demikian surat pemanggilan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
        <br>
        <p>Hormat kami,</p>
        <br>
        <p>..........................................</p>
        <p>Kepala Sekolah</p>
        <br>
        <br>
        <P><u>Herwelis S,pd, m.pd.</u></P>
        NIP.
      </div>
    </body>
  </div>



  <script>
    function printSurat() {
      var printContents = document.getElementById("surat").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; // Mengembalikan tampilan asli setelah mencetak

      // Setelah mencetak, Anda mungkin ingin melakukan redirect kembali ke halaman asal atau melakukan tindakan lainnya.
      // Misalnya:
      // window.location.reload(); // Redirect kembali ke halaman asal
    }

    function printSurat1() {
      var printContents = document.getElementById("printsurat").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; // Mengembalikan tampilan asli setelah mencetak

      // Setelah mencetak, Anda mungkin ingin melakukan redirect kembali ke halaman asal atau melakukan tindakan lainnya.
      // Misalnya:
      // window.location.reload(); // Redirect kembali ke halaman asal
    }
  </script>
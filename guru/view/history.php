<div class="row">
  <div class="col-xs-12 col-md-12 col-lg-12">
    <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == 'hapus') { ?>
      <div style="display: none;" class="alert alert-danger alert-dismissable">Pelanggaran Siswa Berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
    <?php } ?>
    <?php $_SESSION['pesan'] = ''; ?>
    <div class="box box-info">
      <div class="box-header  with-border">
        <h3 class="box-title">&nbsp;History Input Pelanggaran Siswa</h3>
        <span class="pull-right">

          <a href="<?php echo $basegu; ?>inputpelanggaran" class="btn bg-navy btn-sm"><i class="glyphicon glyphicon-plus"></i> Input Pelanggaran</a>
          <button class="btn bg-blue btn-sm mr-2" onclick="printRekap()"><i class="glyphicon glyphicon-print"></i> Print Rekap Pelanggran</button>
        </span>

      </div>

      <!-- Form untuk filter berdasarkan periode berdasarkan tgl -->
      <form method="POST" class="form-inline">
        <div class="form-group" style="margin-left: 11px; ">
          <label for="tgl_mulai" style="font-weight: lighter;"></label>
          <input type="date" name="tgl_mulai" class="form-control" value="<?php echo isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : ''; ?>">
        </div>
        <div class="form-group">
          <label for="tgl_selesai" style="margin-left: 8px; font-weight: lighter;">s.d.</label>
          <input type="date" name="tgl_selesai" class="form-control ml-3" value="<?php echo isset($_POST['tgl_selesai']) ? $_POST['tgl_selesai'] : ''; ?>">
        </div>
        <button type="submit" name="filter_tgl" class="btn btn-primary ml-3" style="margin-left: 10px;">Filter</button>
      </form>

      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="1%">NO</th>
              <th>NAMA SISWA</th>
              <th>KELAS</th>
              <th width="35%">BENTUK PELANGGARAN</th>
              <th width="5%">POIN</th>
              <th width="10%">PADA</th>
              <th class="text-center">OPSI</th>
            </tr>
          </thead>
          <tbody>
            <?php

            // Jika ada filter berdasarkan periode tgl
            if (isset($_POST['filter_tgl'])) {
              $mulai = $_POST['tgl_mulai'];
              $selesai = $_POST['tgl_selesai'];
              if ($mulai != null || $selesai != null) {
                $query = "SELECT * FROM pelanggaran WHERE c_guru='$_SESSION[c_guru]' AND at BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) ORDER BY at DESC";
                // $query = "SELECT * FROM pelanggaran WHERE c_guru='$_SESSION[c_guru]' AND periode='$period' ORDER BY at DESC";
                $smk = mysqli_query($con, $query);
              } else {
                $query = "SELECT * FROM pelanggaran where c_guru='$_SESSION[c_guru]' ORDER BY at DESC ";
                $smk = mysqli_query($con, $query);
              }
            } else {
              $query = "SELECT * FROM pelanggaran where c_guru='$_SESSION[c_guru]' ORDER BY at DESC ";
              $smk = mysqli_query($con, $query);
            }

            $vr = 1;
            while ($akh = mysqli_fetch_array($smk)) {
              $kel = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM kelas where c_kelas='$akh[c_kelas]' "));
              $sis = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM siswa where c_siswa='$akh[c_siswa]' "));
              $ben = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM benpel where c_benpel='$akh[c_benpel]' "));
              // $per = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM pelanggaran where periode='$akh[periode]' "));
              ?>
              <tr>
                <td><?php echo $vr; ?></td>
                <td><?php echo $sis['nama']; ?></td>
                <td><?php echo $kel['kelas']; ?></td>
                <td><?php echo $ben['benpel']; ?></td>
                <td><?php echo $akh['bobot']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($akh['at'])); ?></td>
                <td align="center">

                  <a class="btn btn-danger btn-sm" data-target="#hapus<?php echo $akh['c_pelanggaran']; ?>" data-toggle="modal"><i class="glyphicon glyphicon-remove"></i></a>

                  <a class="pull-right"><a href="<?php echo $basegu; ?>search/<?php echo urlencode($sis['nisn']); ?>/_" class="btn bg-navy btn-sm"><i class="glyphicon glyphicon-info-sign"></i></a></a>

                </td>
              </tr>
              <div id="hapus<?php echo $akh['c_pelanggaran']; ?>" class="modal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Pelanggaran Siswa</h4>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo $basegu; ?>g-control/<?php echo md5('hapuspel') . '/' . $akh['c_pelanggaran']; ?>" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-ok"></i> Lanjutkan</a>
                      <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php $vr++;
            } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->


<!-- Template Surat Panggilan Orang Tua -->
<div id="rekap" style="display: none;">


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
      <!-- Menampilkan Bulan dan Tahun -->
      <p style="font-size: 14px;">
        Periode :
        <?php
        echo date("d/m/Y", strtotime($_POST['tgl_mulai']));
      ?> s.d.
      <?php
      echo date("d/m/Y", strtotime($_POST['tgl_selesai']));
      ?>
    </p>
  </center>
</div>


<!-- Tabel Rekap Data -->
<table class="table table-bordered">
  <thead>
    <tr>
      <th>NO</th>
      <th>Nama Siswa</th>
      <th>Kelas</th>
      <th>Bentuk Pelanggaran</th>
      <th>Poin</th>
      <th>Periode Pelanggaran</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Inisialisasi array untuk mengelompokkan data siswa
    $siswa_data = array();

      // Mengelompokkan data siswa berdasarkan nama
    foreach ($smk as $akh) {
      $sis = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM siswa where c_siswa='$akh[c_siswa]' "));
      $kel = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM kelas where c_kelas='$akh[c_kelas]' "));
      $ben = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM benpel where c_benpel='$akh[c_benpel]' "));

        // Menambahkan tanggal pelanggaran ke dalam array data siswa
      $tanggal_pelanggaran = date("d/m/Y", strtotime($akh['at']));
      if (!isset($siswa_data[$sis['nama']])) {
        $siswa_data[$sis['nama']] = array(
          'nama' => $sis['nama'],
          'kelas' => $kel['kelas'],
          'pelanggaran' => array($ben['benpel']),
          'bobot' => $akh['bobot'],
            'tanggal_pelanggaran' => array($tanggal_pelanggaran) // Menyimpan tanggal pelanggaran
          );
      } else {
          // Jika nama siswa sudah ada dalam array, cek apakah tanggal pelanggaran sudah ada
        if (!in_array($tanggal_pelanggaran, $siswa_data[$sis['nama']]['tanggal_pelanggaran'])) {
            $siswa_data[$sis['nama']]['tanggal_pelanggaran'][] = $tanggal_pelanggaran; // Menambahkan tanggal pelanggaran baru
          }
          $siswa_data[$sis['nama']]['pelanggaran'][] = $ben['benpel']; // Menambahkan jenis pelanggaran
          $siswa_data[$sis['nama']]['bobot'] += $akh['bobot']; // Menambahkan bobot pelanggaran
        }
      }

      // Menampilkan data siswa yang sudah digabung
      $vr = 1;
      foreach ($siswa_data as $data) {
        // Menggabungkan tanggal pelanggaran menjadi rentang tanggal
        $periode_pelanggaran = implode(" - ", $data['tanggal_pelanggaran']);

        echo "<tr>";
        echo "<td>" . $vr . "</td>";
        echo "<td>" . $data['nama'] . "</td>";
        echo "<td>" . $data['kelas'] . "</td>";
        echo "<td>" . implode(", ", $data['pelanggaran']) . "</td>";
        echo "<td>" . $data['bobot'] . "</td>";
        echo "<td>" . $periode_pelanggaran . "</td>";
        echo "</tr>";
        $vr++;
      }
      ?>
    </tbody>
  </table>

  <div style="margin-right: 20px;">
    <table align="right">
      <tr>
        <td>
          SMKN 7 Makassar, <?php echo tgl(date('d-m-Y')); ?>
          <br />
          Guru Bimbingan Konseling <br />
          <br />
          <br />
          <br />
          <u>Erni Marlina</u>
          <br />
          NIP. 197407212006042034
        </td>
      </tr>
    </table>
  </div>

  <div>
    <table align="left">
      <tr>
        <td>
          <br />
          Kepala Sekolah <br />
          <br />
          <br />
          <br />
          <u>Herwelis S,pd, m.pd.</u>
          <br />
          NIP.
        </td>
      </tr>
    </table>
  </div>






  <script>
    function printRekap() {
      var printContents = document.getElementById("rekap").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; // Mengembalikan tampilan asli setelah mencetak

      // Setelah mencetak, Anda mungkin ingin melakukan redirect kembali ke halaman asal atau melakukan tindakan lainnya.
      // Misalnya:
      // window.location.reload(); // Redirect kembali ke halaman asal
    }
  </script>
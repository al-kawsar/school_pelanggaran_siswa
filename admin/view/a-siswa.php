<?php
if (isset($_GET['q'])) {
  $poskelas = mysqli_query($con, "SELECT * FROM kelas WHERE c_kelas='$_GET[q]'");
  $dkelas = mysqli_fetch_array($poskelas);
}
?>
<div class="row">
  <div class="col-xs-12 col-md-12 col-lg-12">
    <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == 'edit') { ?>
      <div class="alert alert-success alert-dismissable fade show" role="alert">Siswa Berhasil Diedit
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == 'hapus') { ?>
      <div class="alert alert-danger alert-dismissable fade show" role="alert">Siswa Berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <?php $_SESSION['pesan'] = ''; ?>
    <div class="box box-info">
      <div class="box-header with-border">
        <?php if (isset($_GET['q'])) { ?>
          <h3 class="box-title">Seluruh Siswa Kelas <?php echo $dkelas['kelas']; ?></h3>
          <span class="float-right"><a href="<?php echo $basead; ?>addsiswa/<?php echo $_GET['q']; ?>" class="btn btn-circle btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah Siswa</a></span>
        <?php } else { ?>
          <h3 class="box-title">Seluruh Siswa</h3>
        <?php } ?>
      </div>
      <!-- /.box-header -->

      <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>NISN</th>
              <?php if (empty($_GET['q'])) {
                echo '<th width="12%">Kelas</th>';
              } ?>
              <th>Nama</th>
              <th width="5%">Poin</th>
              <th class="text-center" width="25%">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_GET['q'])) {
              $smk = mysqli_query($con, "SELECT * FROM siswa WHERE c_kelas='$_GET[q]' ORDER BY nama ASC");
            } else {
              $smk = mysqli_query($con, "SELECT * FROM siswa ORDER BY nama ASC");
            }
            $vr = 1;
            while ($akh = mysqli_fetch_array($smk)) {
              $kk = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM kelas WHERE c_kelas='$akh[c_kelas]'"));
              $p = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(bobot) AS p FROM pelanggaran WHERE c_siswa='$akh[c_siswa]'")); ?>
              <tr>
                <td><?php echo $vr; ?></td>
                <td><?php echo $akh['nisn']; ?></td>
                <?php if (empty($_GET['q'])) {
                  echo '<td>' . $kk['kelas'] . '</td>';
                } ?>
                <td><a href="<?php echo $basead; ?>search/<?php echo $akh['nisn']; ?>"><?php echo $akh['nama']; ?></a></td>
                <td class="text-center"><?php echo $p['p']; ?></td>
                <td class="text-center">
                  <a href="<?php echo $basead; ?>editsiswa/<?php echo $akh['c_siswa']; ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $akh['c_siswa']; ?>"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                </td>
              </tr>

              <div id="hapus<?php echo $akh['c_siswa']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabel">Konfirmasi Hapus Siswa</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Jika Anda Menghapus Data Ini, Akan Berpengaruh Pada</p>
                      <b>1. Data Dari Siswa (<?php echo $akh['nama']; ?>) Juga Terhapus<br>2. Data Pelanggaran Siswa (<?php echo $akh['nama']; ?>) Secara Keseluruhan Juga Terhapus</b>
                    </div>
                    <div class="modal-footer">
                      <?php if (isset($_GET['q'])) { ?>
                        <a href="<?php echo $basead; ?>a-control/<?php echo md5('hapussiswa') . '/' . $akh['c_siswa']; ?>" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-ok"></i> Lanjutkan</a>
                      <?php } else { ?>
                        <a href="<?php echo $basead; ?>a-control/<?php echo md5('hapussiswa2') . '/' . $akh['c_siswa']; ?>" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-ok"></i> Lanjutkan</a>
                      <?php } ?>
                      <button class="btn btn-secondary" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
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
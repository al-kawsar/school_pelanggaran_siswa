<?php
if (isset($_GET['q'])) {
  $jenpel = mysqli_query($con, "SELECT * FROM katbenpel where c_katbenpel='$_GET[q]' ");
  $hjenpel = mysqli_fetch_array($jenpel);
}
?>

<div class="row">
  <div class="col-xs-12 col-md-12 col-lg-12">

    <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == 'edit') { ?>
      <div style="display: none;" class="alert alert-success alert-dismissable">Bentuk Pelanggaran Berhasil Diedit
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
    <?php } ?>
    <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] == 'hapus') { ?>
      <div style="display: none;" class="alert alert-danger alert-dismissable">Bentuk Pelanggaran Berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
    <?php } ?>


    <?php $_SESSION['pesan'] = ''; ?>
    <div class="box box-info">
      <div class="box-header  with-border">
        <?php if (isset($_GET['q'])) { ?>
          <h3 class="box-title"></span>&nbsp;Bentuk Pelanggaran Kategori <b><?php echo $hjenpel['katbenpel']; ?></b></h3><span style="float:right;"><a href="<?php echo $basead; ?>addbentukpelanggaran/<?php echo $_GET['q']; ?>" class="btn btn-circle btn-primary"><i class="glyphicon glyphicon-plus"></i> Bentuk Pelanggaran</a></span>
        <?php } else { ?>
          <h3 class="box-title"></span>&nbsp;Bentuk Pelanggaran</h3>
        <?php } ?>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="5%">NO</th>
              <?php if (empty($_GET['q'])) {
                echo '<th>KATEGORI</th>';
              } ?>
              <th>BENTUK PELANGGARAN</th>
              <th class="text-center" width="10%">POIN</th>
              <th class="text-center" width="20%">OPSI</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_GET['q'])) {
              $smk = mysqli_query($con, "SELECT * FROM benpel where c_katbenpel='$_GET[q]' order by bobot asc ");
            } else {
              $smk = mysqli_query($con, "SELECT * FROM benpel order by bobot asc ");
            }
            $vr = 1;
            while ($akh = mysqli_fetch_array($smk)) {
              $kb = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM katbenpel where c_katbenpel='$akh[c_katbenpel]' ")); ?>
              <tr>
                <td><?php echo $vr; ?></td>
                <?php if (empty($_GET['q'])) {
                  echo '<td>' . $kb['katbenpel'] . '</td>';
                } ?>
                <td><?php echo $akh['benpel']; ?></td>
                <td class="text-center"><?php echo $akh['bobot']; ?></td>
                <td align="center">
                  <a data-target="#edit<?php echo $akh['c_benpel']; ?>" data-toggle="modal" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-danger btn-sm" href="<?php echo $basead; ?>a-control/<?php echo md5('hapusbenpel') . '/' . $akh['c_benpel']; ?>"><i class="glyphicon glyphicon-remove"></i> Hapus</a>

                </td>
              </tr>
              <div id="hapus<?php echo $akh['c_benpel']; ?>" class="modal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Bentuk Pelanggaran</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                      // Query to check if the data is used in another table
                      $check_usage = mysqli_query($con, "SELECT COUNT(*) AS count FROM pelanggaran WHERE c_benpel='$akh[c_benpel]'");
                      $usage_result = mysqli_fetch_assoc($check_usage);
                      // Display message based on usage result
                      if ($usage_result['count'] > 0) {
                        echo "<p>Data ini masih digunakan pada tabel pelanggaran.</p>";
                        echo "<p>Anda tidak dapat menghapus data ini karena akan berpengaruh pada data pelanggaran yang terkait.</p>";
                      } else {
                        echo "<p>Jika Anda Menghapus Data Ini, Akan Berpengaruh Pada</p>";
                        echo "<b>1. Data Pelanggaran Siswa Yang Berhubungan Dengan ($akh[benpel]) Secara Keseluruhan Juga Terhapus</b>";
                      }
                      ?>
                    </div>
                    <div class="modal-footer">
                      <?php if ($usage_result['count'] == 0) { ?>
                        <a href="<?php echo $basead; ?>a-control/<?php echo md5('hapusbenpel') . '/' . $akh['c_benpel']; ?>" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-ok"></i> Lanjutkan</a>
                      <?php } ?>
                      <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="edit<?php echo $akh['c_benpel']; ?>" class="modal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" id="myModalLabel">Edit Bentuk Pelanggaran</h4>
                    </div>
                    <?php if (isset($_GET['q'])) { ?>
                      <form role="form" method="post" enctype="multipart/form-data" action="<?php echo $basead; ?>a-control/<?php echo md5('editbenpel'); ?>/access">
                      <?php } else { ?>
                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo $basead; ?>a-control/<?php echo md5('editbenpel2'); ?>/access">
                        <?php } ?>
                        <input type="hidden" name="c_benpel" value="<?php echo $akh['c_benpel']; ?>">
                        <input type="hidden" name="c_katbenpel" value="<?php echo $akh['c_katbenpel']; ?>">
                        <div class="box-body">
                          <div class="form-group">
                            <label>BENTUK PELANGGARAN</label>
                            <textarea type="text" name="benpel" class="form-control"><?php echo $akh['benpel']; ?></textarea>
                          </div>
                          <div class="form-group">
                            <label>POIN</label>
                            <input type="text" name="bobot" class="form-control" onkeypress="return hanyaangka(event)" value="<?php echo $akh['bobot']; ?>">
                          </div>
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
                        </div>
                        </form>
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
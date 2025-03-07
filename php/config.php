<?php
$dbhost ='localhost';
$dbuser ='root';
$dbpass ='';
$dbname ='school_pbo_pel1';
$db_dsn = "mysql:dbname=$dbname;host=$dbhost";
try {
  $db = new PDO($db_dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
  echo 'Connection failed: '.$e->getMessage();
}
$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
/*css.plugin.hancon <?php echo $base; ?>*/
$base='http://localhost/pelanggaran_siswa/';
/*control(link.redirect) <?php echo $basecon; ?>*/
$basead='http://localhost/pelanggaran_siswa/admin/';
/*kelas(link.redirect) <?php echo $basekel; ?>*/
$basegu='http://localhost/pelanggaran_siswa/guru/';
$basewa='http://localhost/pelanggaran_siswa/walimurid/';
?>

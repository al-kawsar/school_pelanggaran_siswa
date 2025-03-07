<?php
function rp($str)
{
  $jum = strlen($str);
  $jumtitik = ceil($jum / 3);
  $balik = strrev($str);

  $awal = 0;
  $akhir = 3;
  for ($x = 0; $x < $jumtitik; $x++) {
    $a[$x] = substr($balik, $awal, $akhir) . ".";
    $awal += 3;
  }
  $hasil = implode($a);
  $hasilakhir = strrev($hasil);
  $hasilakhir = substr($hasilakhir, 1, $jum + $jumtitik);

  return "" . $hasilakhir . "";
}

function tgl($date)
{
  $array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  $date = strtotime($date);
  $tanggal = date('j', $date);
  $bulan = $array_bulan[date('n', $date)];
  $tahun = date('Y', $date);
  $result = $tanggal . " " . $bulan . " " . $tahun;
  return $result;
}

function bulan($bulan)
{
  $namabulan = '';
  switch ($bulan) {
    case '01':
      $namabulan = "Januari";
      break;
    case '02':
      $namabulan = "Februari";
      break;
    case '03':
      $namabulan = "Maret";
      break;
    case '04':
      $namabulan = "April";
      break;
    case '05':
      $namabulan = "Mei";
      break;
    case '06':
      $namabulan = "Juni";
      break;
    case '07':
      $namabulan = "Juli";
      break;
    case '08':
      $namabulan = "Agustus";
      break;
    case '09':
      $namabulan = "September";
      break;
    case '10':
      $namabulan = "Oktober";
      break;
    case '11':
      $namabulan = "November";
      break;
    case '12':
      $namabulan = "Desember";
      break;
  }
  return $namabulan;
}

function hari($hari)
{
  $daftar_hari = array('Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu');
  $hariini = date('l', strtotime($hari));
  return $daftar_hari[$hariini];
}

function h($h)
{
  $hr = '';
  switch ($h) {
    case '1':
      $hr = 'Senin';
      break;
    case '2':
      $hr = 'Selasa';
      break;
    case '3':
      $hr = 'Rabu';
      break;
    case '4':
      $hr = 'Kamis';
      break;
    case '5':
      $hr = 'Jumat';
      break;
    case '6':
      $hr = 'Sabtu';
      break;
    case '7':
      $hr = 'Minggu';
      break;
  }
  return $hr;
}

function random($length)
{
  $data = '1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSstuuUvVwWxXyYyZz';
  $string = '';
  for ($i = 1; $i <= $length; $i++) {
    $pos = rand(0, strlen($data) - 1);
    $string .= $data[$pos];
  }
  return $string;
}

function l($linku)
{
  $l = substr(md5($linku), 0, 9);
  return $l;
}

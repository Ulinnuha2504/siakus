<?php
// #KONFIGURASI DEFAULT
 $username="root";
 $password="";
 $database="siakus";
 $server  ="localhost";


// $username="ulinnuha";       //username mysql
// $password="12345678";       //password
// $database="siakus";         //nama databae (siakus)
// $server  ="localhost";      //ipserver

 $kon = mysqli_connect($server,$username,$password,$database);
 if(mysqli_connect_error()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
    }
date_default_timezone_set('Asia/Jakarta');
$hariini = date("Y-m-d");
$mutasi=0;
function terbilang($angka) {
    $bilangan = array(
        '',
        'satu',
        'dua',
        'tiga',
        'empat',
        'lima',
        'enam',
        'tujuh',
        'delapan',
        'sembilan'
    );
    $temp = "";
    if ($angka < 10) {
        $temp = $bilangan[$angka];
    } elseif ($angka < 20) {
        $temp = terbilang($angka - 10) . " belas";
    } elseif ($angka < 100) {
        $temp = terbilang($angka / 10) . " puluh " . terbilang($angka % 10);
    } elseif ($angka < 200) {
        $temp = " seratus " . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        $temp = terbilang($angka / 100) . " ratus " . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        $temp = " seribu " . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        $temp = terbilang($angka / 1000) . " ribu " . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        $temp = terbilang($angka / 1000000) . " juta " . terbilang($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        $temp = terbilang($angka / 1000000000) . " milyar " . terbilang($angka % 1000000000);
    } elseif ($angka < 1000000000000000) {
        $temp = terbilang($angka / 1000000000000) . " trilyun " . terbilang($angka % 1000000000000);
    }
    return $temp;
}

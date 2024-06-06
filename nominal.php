<?php
// Memanggil Koneksi
include("koneksi.php");
// query data menu sesuai dengan id menu yang diambil
$query  = mysqli_query($kon,"SELECT*FROM kategori_penerimaan WHERE kpn_id='".$_GET['idkt']."'");
$data   = mysqli_fetch_array($query);
echo json_encode($data);
?>
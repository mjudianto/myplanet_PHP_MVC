<?php
include("../../conf/connect.php");

$mynik = $_POST["mynik"];
$username = $_POST["username"];
$judul = $_POST["judul"];
$isi = $_POST["isi"];
$isibersih = preg_replace('/\s+/', '', $isi);  // remove whitespace
$panjangisi = strlen($isibersih);


if ($panjangisi >= 150) {
    # code...

    echo "ok proses";

    $masukan = mysqli_prepare($conn, "INSERT INTO `leadership_festival_feedback` (`nik`, `judul`, `isi`)  VALUES (?,?,?)");
    mysqli_stmt_bind_param($masukan, "sss", $mynik, $judul, $isi);
    mysqli_stmt_execute($masukan);



} else {

    echo "terlalu pendek/panjang";
}




// $arr = get_defined_vars();
// print_r($arr);

?>
<?php
$host     = "localhost"; 
$user     = "root";      
$password = "";          
$dbname   = "data_skrining";  

// buat koneksi
$koneksi = mysqli_connect($host, $user, $password, $dbname);

// cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// echo "Koneksi berhasil"; // bisa diaktifkan buat test
?>

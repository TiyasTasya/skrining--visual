<?php
include "koneksi.php"; 

$pesan = "";

// Proses simpan data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal      = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tanda_gejala = mysqli_real_escape_string($koneksi, $_POST['tanda_gejala']);

    // Gabungkan ceklis sesuai kategori yang dipilih
    $keterangan = "";
    if ($tanda_gejala == "1" && !empty($_POST['ceklis_merah'])) {
        $keterangan = implode(", ", $_POST['ceklis_merah']);
    } elseif ($tanda_gejala == "2" && !empty($_POST['ceklis_orange'])) {
        $keterangan = implode(", ", $_POST['ceklis_orange']);
    } elseif ($tanda_gejala == "3" && !empty($_POST['ceklis_kuning'])) {
        $keterangan = implode(", ", $_POST['ceklis_kuning']);
    } elseif ($tanda_gejala == "4" && !empty($_POST['ceklis_hijau'])) {
        $keterangan = implode(", ", $_POST['ceklis_hijau']);
    } elseif ($tanda_gejala == "5" && !empty($_POST['ceklis_putih'])) {
        $keterangan = implode(", ", $_POST['ceklis_putih']);
    }

    // Simpan ke database
    $sql = "INSERT INTO skrining (tanggal, nama, tanda_gejala, keterangan) 
            VALUES ('$tanggal', '$nama', '$tanda_gejala', '$keterangan')";

    if (mysqli_query($koneksi, $sql)) {
        $pesan = '<div class="alert alert-success mt-3">✅ Data berhasil disimpan!</div>';
    } else {
        $pesan = '<div class="alert alert-danger mt-3">❌ Gagal menyimpan data: ' . mysqli_error($koneksi) . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Skrining Visual</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    .navbar {
      padding-top: 1rem;
      padding-bottom: 1rem;
      font-size: 1.1rem;
    }
    .navbar-brand { font-size: 1.3rem; font-weight: bold; }
    .box { color: #fff; padding: 8px; margin-top: 8px; }
    .red    { background: #ff0000; }
    .orange { background: #FFA500; }
    .yellow { background: #EED202; color: #000; }
    .green  { background: #228B22; }
    .white  { background: #fff; color: #000; border: 1px solid #ddd; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Skrining Visual Klinik Pratama</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="skrining.php">Skrining</a></li>
      <li class="nav-item"><a class="nav-link" href="data-skrining.php">Data Skrining</a></li>
    </ul>
    <div class="ml-auto">
      <img src="asset/gambar/logo_upk.png" alt="Logo" height="45">
    </div>
  </div>
</nav>

<!-- Judul -->
<div class="container text-center mt-4">
  <h3>SKRINING VISUAL RAWAT JALAN <br>(Klinik Pratama UPK Kemenkes)</h3>
</div>

<!-- Form -->
<div class="container d-flex justify-content-center align-items-start mt-4">
  <div class="col-sm-10 col-md-8">
    <form method="POST" action="">
      <!-- Hari/Tanggal -->
      <div class="form-group row">
        <label for="tanggal" class="col-sm-3 col-form-label"><b>Hari/Tanggal</b></label>
        <div class="col-sm-9">
          <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
      </div>

      <!-- Nama/Inisial -->
      <div class="form-group row">
        <label for="nama" class="col-sm-3 col-form-label"><b>Nama/Inisial</b></label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Inisial Pasien" required>
        </div>
      </div>

      <!-- Tanda dan Gejala -->
      <div class="form-group row">
        <label class="col-sm-3 col-form-label"><b>Tanda dan Gejala</b></label>
        <div class="col-sm-9">

          <!-- Merah -->
          <div class="red box">
            <input type="radio" name="tanda_gejala" value="1" required> <strong>MERAH</strong>
          </div>
          <div class="pl-4">
            <div class="form-check"><input type="checkbox" name="ceklis_merah[]" value="Tidak sadarkan diri / pingsan"> Tidak sadarkan diri / pingsan</div>
            <div class="form-check"><input type="checkbox" name="ceklis_merah[]" value="Tidak bernafas / kesulitan bernafas"> Tidak bernafas / kesulitan bernafas</div>
            <div class="form-check"><input type="checkbox" name="ceklis_merah[]" value="Nadi tidak teraba / henti jantung"> Nadi tidak teraba / henti jantung</div>
            <div class="form-check"><input type="checkbox" name="ceklis_merah[]" value="Kejang berulang / lama"> Kejang berulang / lama</div>
            <div class="form-check"><input type="checkbox" name="ceklis_merah[]" value="Nyeri hebat"> Nyeri hebat</div>
          </div>

          <!-- Orange -->
          <div class="orange box">
            <input type="radio" name="tanda_gejala" value="2"> <strong>ORANGE</strong>
          </div>
          <div class="pl-4">
            <div class="form-check"><input type="checkbox" name="ceklis_orange[]" value="Nyeri dada"> Nyeri dada</div>
            <div class="form-check"><input type="checkbox" name="ceklis_orange[]" value="Tampak pucat"> Tampak pucat</div>
          </div>

          <!-- Kuning -->
          <div class="yellow box">
            <input type="radio" name="tanda_gejala" value="3"> <strong>KUNING</strong>
          </div>
          <div class="pl-4">
            <div class="form-check"><input type="checkbox" name="ceklis_kuning[]" value="Lemas"> Lemas</div>
            <div class="form-check"><input type="checkbox" name="ceklis_kuning[]" value="Lansia"> Lansia</div>
            <div class="form-check"><input type="checkbox" name="ceklis_kuning[]" value="Ibu hamil"> Ibu hamil</div>
            <div class="form-check"><input type="checkbox" name="ceklis_kuning[]" value="Bayi / Balita"> Bayi / Balita</div>
          </div>

          <!-- Hijau -->
          <div class="green box">
            <input type="radio" name="tanda_gejala" value="4"> <strong>HIJAU</strong>
          </div>
          <div class="pl-4">
            <div class="form-check"><input type="checkbox" name="ceklis_hijau[]" value="Kondisi stabil"> Kondisi stabil</div>
          </div>

          <!-- Putih -->
          <div class="white box">
            <input type="radio" name="tanda_gejala" value="5"> <strong>RISIKO JATUH</strong>
          </div>
          <div class="pl-4">
            <div class="form-check"><input type="checkbox" name="ceklis_putih[]" value="Menggunakan alat bantu jalan"> Menggunakan alat bantu jalan</div>
            <div class="form-check"><input type="checkbox" name="ceklis_putih[]" value="Gangguan pola berjalan"> Gangguan pola berjalan</div>
            <div class="form-check"><input type="checkbox" name="ceklis_putih[]" value="Penutup salah satu mata"> Penutup salah satu mata</div>
          </div>
        </div>
      </div>

      <!-- Tombol -->
      <div class="form-group row mt-4">
        <div class="col-sm-9 offset-sm-3">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </div>
    </form>

    <!-- Pesan -->
    <?php if ($pesan) echo $pesan; ?>
  </div>
</div>
</body>
</html>

<?php
include 'koneksi.php';

$nama    = mysqli_real_escape_string($koneksi, $_GET['nama']);
$tanggal = mysqli_real_escape_string($koneksi, $_GET['tanggal']);

$q     = mysqli_query($koneksi, "SELECT * FROM skrining WHERE nama='$nama' AND tanggal='$tanggal' LIMIT 1");
$data  = mysqli_fetch_assoc($q);

if (!$data) {
    die("Data tidak ditemukan.");
}

function is_checked($item, $data) {
    // pecah string database jadi array
    $selected = explode(',', $data);
    // hapus spasi di setiap item
    $selected = array_map('trim', $selected);
    return in_array($item, $selected) ? 'checked' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Cetak Data-Skrining</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    table th, table td {
      border: 1px solid #000;
      padding: 4px 6px;
      vertical-align: top;
    }
    .borderless td {
      border: none !important;
    }
    .red    { background: #ff0000 !important; color: #fff !important; font-weight: bold; }
    .orange { background: #ff9800 !important; color: #fff !important; font-weight: bold; }
    .yellow { background: #fdd835 !important; color: #000 !important; font-weight: bold; }
    .green  { background: #228B22 !important; color: #fff !important; font-weight: bold; }
    .blue   { background: #e8f4ff !important; color: #000 !important; font-weight: bold; }
    .arrow img { width: 28px; }
    .final-box {
      border: 1px solid #000;
      text-align: center;
      font-weight: bold;
      padding: 8px;
    }
    input[type=checkbox] { transform: scale(1.2); }
  </style>
</head>
<body onload="window.print()">

<div class="container">
  <h3 class="text-center">
    SKRINING VISUAL RAWAT JALAN<br>KLINIK PRATAMA UPK KEMENKES
  </h3>

  <!-- Data Pasien -->
  <table>
    <tr>
      <th width="25%">HARI/TANGGAL</th>
      <td>: <?= date("d-m-Y", strtotime($data['tanggal'])); ?></td>
    </tr>
    <tr>
      <th>NAMA / INISIAL</th>
      <td>: <?= htmlspecialchars($data['nama']); ?></td>
    </tr>
  </table>

  <!-- Tabel Skrining -->
  <table style="font-size: 13px; margin-top: 10px;">
    <tr>
      <th></th>
      <th class="text-center red">MERAH</th>
      <th class="text-center orange">ORANGE</th>
      <th class="text-center yellow">KUNING</th>
      <th class="text-center green">HIJAU</th>
      <th class="text-center blue">RISIKO JATUH</th>
    </tr>

    <tr>
  <td><b>Tanda & Gejala</b></td>

  <!-- Merah -->
  <td>
    <table class="borderless">
      <tr><td><input type="checkbox" <?= is_checked('Tidak sadarkan diri / pingsan', $data['keterangan']) ?>></td><td>Tidak sadarkan diri / pingsan</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Tidak bernafas / kesulitan bernafas', $data['keterangan']) ?>></td><td>Tidak bernafas / kesulitan bernafas</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Nadi tidak teraba / henti jantung', $data['keterangan']) ?>></td><td>Nadi tidak teraba / henti jantung</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Kejang berulang / lama', $data['keterangan']) ?>></td><td>Kejang berulang / lama</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Nyeri hebat', $data['keterangan']) ?>></td><td>Nyeri hebat</td></tr>
    </table>
  </td>

  <!-- Orange -->
  <td>
    <table class="borderless">
      <tr><td><input type="checkbox" <?= is_checked('Nyeri dada', $data['keterangan']) ?>></td><td>Nyeri dada</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Tampak pucat', $data['keterangan']) ?>></td><td>Tampak pucat</td></tr>
    </table>
  </td>

  <!-- Kuning -->
  <td>
    <table class="borderless">
      <tr><td><input type="checkbox" <?= is_checked('Lemas', $data['keterangan']) ?>></td><td>Lemas</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Lansia', $data['keterangan']) ?>></td><td>Lansia</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Ibu hamil', $data['keterangan']) ?>></td><td>Ibu hamil</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Bayi / Balita', $data['keterangan']) ?>></td><td>Bayi / Balita</td></tr>
    </table>
  </td>

  <!-- Hijau -->
  <td>
    <table class="borderless">
      <tr><td><input type="checkbox" <?= is_checked('Kondisi stabil', $data['keterangan']) ?>></td><td>Kondisi stabil</td></tr>
    </table>
  </td>

  <!-- Risiko Jatuh -->
  <td>
    <table class="borderless">
      <tr><td><input type="checkbox" <?= is_checked('Menggunakan alat bantu jalan', $data['keterangan']) ?>></td><td>Menggunakan alat bantu jalan</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Gangguan pola berjalan', $data['keterangan']) ?>></td><td>Gangguan pola berjalan</td></tr>
      <tr><td><input type="checkbox" <?= is_checked('Penutup salah satu mata', $data['keterangan']) ?>></td><td>Penutup salah satu mata</td></tr>
    </table>
  </td>
</tr>

    <!-- Panah -->
    <tr class="arrow">
      <td></td>
      <td class="text-center"><img src="asset/gambar/panah.png" alt="→"></td>
      <td class="text-center"><img src="asset/gambar/panah.png" alt="→"></td>
      <td class="text-center"><img src="asset/gambar/panah.png" alt="→"></td>
      <td class="text-center"><img src="asset/gambar/panah.png" alt="→"></td>
      <td class="text-center"><img src="asset/gambar/panah.png" alt="→"></td>
    </tr>

    <!-- Ruang Tujuan -->
    <tr>
      <td></td>
      <td colspan="2"><div class="final-box">UGD / RUANG TINDAKAN</div></td>
      <td><div class="final-box">PENDAFTARAN KEBUTUHAN KHUSUS</div></td>
      <td><div class="final-box">ANTRIAN STABIL</div></td>
      <td><div class="final-box">KURSI RODA / ANTRIAN KHUSUS</div></td>
    </tr>
  </table>
</div>

</body>
</html>

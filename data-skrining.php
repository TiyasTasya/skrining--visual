<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Skrining - Visual</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- jQuery + Bootstrap Bundle -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
 <style>
    /* Perbesar navbar */
    .navbar {
      padding-top: 1rem;
      padding-bottom: 1rem;
      font-size: 1.1rem; /* perbesar teks */
    }
    .navbar-brand {
      font-size: 1.3rem; /* judul lebih besar */
      font-weight: bold;
    }
    .navbar-nav .nav-link {
      font-size: 1.1rem;
    }
  </style>
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

<div class="container mt-4">
  <h3 class="text-center">DATA SKRINING VISUAL RAWAT JALAN <br>(Klinik Pratama UPK Kemenkes)</h3>

  <!-- Form filter tanggal manual -->
  <div class="card shadow-sm mt-4">
    <div class="card-header bg-info text-white">
      <h5 class="mb-0">Cari Berdasarkan Tanggal</h5>
    </div>
    <div class="card-body">
      <form method="GET" action="">
        <div class="form-row">
          <div class="form-group col-md-5">
            <label for="tanggal_awal">Dari</label>
            <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" required>
          </div>
          <div class="form-group col-md-5">
            <label for="tanggal_akhir">Sampai</label>
            <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" required>
          </div>
          <div class="form-group col-md-2 d-flex align-items-end">
            <button class="btn btn-info mr-2" type="submit">Cari</button>
            <a href="data-skrining.php" class="btn btn-secondary">Reset</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Filter cepat -->
  <div class="mt-3">
    <a href="?filter=hari_ini" class="btn btn-sm btn-primary">Hari ini</a>
    <a href="?filter=kemarin" class="btn btn-sm btn-primary">Kemarin</a>
    <a href="?filter=7_hari" class="btn btn-sm btn-primary">7 hari terakhir</a>
    <a href="?filter=30_hari" class="btn btn-sm btn-primary">30 hari terakhir</a>
    <a href="?filter=bulan_ini" class="btn btn-sm btn-primary">Bulan ini</a>
    <a href="?filter=bulan_lalu" class="btn btn-sm btn-primary">Bulan lalu</a>
  </div>

  <!-- PHP Ambil data -->
  <?php
  include 'koneksi.php';

  $tanggal_awal  = "";
  $tanggal_akhir = "";

  if (isset($_GET['filter'])) {
      $filter = $_GET['filter'];
      switch ($filter) {
          case "hari_ini":
              $tanggal_awal = date("Y-m-d");
              $tanggal_akhir = date("Y-m-d");
              break;
          case "kemarin":
              $tanggal_awal = date("Y-m-d", strtotime("-1 day"));
              $tanggal_akhir = date("Y-m-d", strtotime("-1 day"));
              break;
          case "7_hari":
              $tanggal_awal = date("Y-m-d", strtotime("-7 days"));
              $tanggal_akhir = date("Y-m-d");
              break;
          case "30_hari":
              $tanggal_awal = date("Y-m-d", strtotime("-30 days"));
              $tanggal_akhir = date("Y-m-d");
              break;
          case "bulan_ini":
              $tanggal_awal = date("Y-m-01");
              $tanggal_akhir = date("Y-m-t");
              break;
          case "bulan_lalu":
              $tanggal_awal = date("Y-m-01", strtotime("-1 month"));
              $tanggal_akhir = date("Y-m-t", strtotime("-1 month"));
              break;
      }
  } elseif (!empty($_GET['tanggal_awal']) && !empty($_GET['tanggal_akhir'])) {
      $tanggal_awal  = $_GET['tanggal_awal'];
      $tanggal_akhir = $_GET['tanggal_akhir'];
  }

  if ($tanggal_awal && $tanggal_akhir) {
      echo "<p class='mt-3'><b>Periode:</b> $tanggal_awal s.d $tanggal_akhir</p>";
      $query = "SELECT * FROM skrining 
                WHERE DATE(tanggal) BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
                ORDER BY tanggal DESC";
  } else {
      $query = "SELECT * FROM skrining ORDER BY tanggal DESC";
  }

  $result = mysqli_query($koneksi, $query);
  ?>

  <!-- Tabel Data -->
  <div class="card mt-3 shadow-sm">
    <div class="card-body">
      <table id="tabelSkrining" class="table table-bordered table-striped">
        <thead class="thead-light text-center">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama/Inisial</th>
            <th>Tanda & Gejala</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
<?php
$no = 1;
while ($data = mysqli_fetch_array($result)) {
    // aman-kan output tampil di HTML
    $tanggal = htmlspecialchars($data['tanggal']);
    $nama    = htmlspecialchars($data['nama']);
    $keterangan = htmlspecialchars($data['keterangan']);
    // badge warna
    $warna = '';
    switch ($data['tanda_gejala']) {
        case '1': $warna = "<span class='badge badge-danger'>MERAH</span>"; break;
        case '2': $warna = "<span class='badge badge-warning text-dark'>ORANGE</span>"; break;
        case '3': $warna = "<span class='badge badge-warning'>KUNING</span>"; break;
        case '4': $warna = "<span class='badge badge-success'>HIJAU</span>"; break;
        case '5': $warna = "<span class='badge badge-primary'>RISIKO JATUH</span>"; break;
        default:  $warna = "<span class='badge badge-secondary'>-</span>";
    }

    // buat parameter URL yang aman
    $nama_param = urlencode($data['nama']);
    $tanggal_param = urlencode($data['tanggal']);

    echo "<tr class='text-center'>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>{$tanggal}</td>";
    echo "<td>{$nama}</td>";
    echo "<td>{$warna}</td>";
    echo "<td>{$keterangan}</td>";
    echo "<td>
            <a href='print.php?nama={$nama_param}&tanggal={$tanggal_param}' target='_blank' class='btn btn-sm btn-secondary'>
              Print Data
            </a>
          </td>";
    echo "</tr>";
}
?>
</tbody>

      </table>
    </div>
  </div>
</div>

<!-- Script DataTables -->
<script>
$(document).ready(function () {
  $('#tabelSkrining').DataTable({
    "language": {
      "search": "Cari Data:",
      "lengthMenu": "Tampilkan _MENU_ data",
      "zeroRecords": "Data tidak ditemukan",
      "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
      "infoEmpty": "Tidak ada data tersedia",
      "infoFiltered": "(disaring dari _MAX_ total data)"
    }
  });
});
</script>

</body>
</html>

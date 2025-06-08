<?php
include 'koneksi.php';

$q = "SELECT nama_produk, stok, harga FROM Produk";
$result = sqlsrv_query($conn, $q);

$totalKeseluruhan = 0;
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Laporan Detil Produk</h2>
        <!-- Tombol Export -->
        <div class="mb-3">
            <a href="export_excel.php" class="btn btn-success">Export to Excel</a>
            <a href="export_pdf.php" class="btn btn-danger">Export to PDF</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Total Uang per Produk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)):
                        $totalPerProduk = $row['harga'] * $row['stok'];
                        $totalKeseluruhan += $totalPerProduk;
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                            <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td>Rp<?= number_format($totalPerProduk, 0, ',', '.') ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr class="table-secondary fw-bold">
                        <td colspan="4" class="text-end">Total Keseluruhan</td>
                        <td>Rp<?= number_format($totalKeseluruhan, 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>

</html>
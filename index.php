<?php
include 'koneksi.php';

$q = "SELECT * FROM Produk";
$result = sqlsrv_query($conn, $q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD dengan PHP & SQL Server</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:wght@500;788&display-swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        h1 {
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center fw-bold mb-4">CRUD PHP & SQL Server</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Data Produk</h4>
            <a href="create.php" class="btn btn-primary">+ Tambah Produk</a>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="laporan.php" class="btn btn-primary">Cetak Laporan</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['id_produk'] ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td><?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id_produk'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="edit.php?id=<?= $row['id_produk'] ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDelete<?= $row['id_produk'] ?>">Hapus</a>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmDelete<?= $row['id_produk'] ?>"
                                tabindex="-1" aria-labelledby="modalLabel<?= $row['id_produk'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="delete.php" method="POST">
                                        <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel<?= $row['id_produk'] ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus produk
                                                "<strong><?= htmlspecialchars($row['nama_produk']) ?></strong>"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <footer class="text-center mt-5">
        <p>Nayaka Ivana Putra. &copy; 2025 CRUD PHP & SQL Server.</p>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>
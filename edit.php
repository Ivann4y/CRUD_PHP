<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$q = "SELECT * FROM Produk WHERE id_produk = ?";
$stmt = sqlsrv_query($conn, $q, [$id]);
$data = sqlsrv_fetch_array(($stmt), SQLSRV_FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $updateQuery = "UPDATE Produk SET nama_produk = ?, stok = ?, harga = ? WHERE id_produk = ?";
    $params = [$nama_produk, $stok, $harga, $id];
    $updateStmt = sqlsrv_query($conn, $updateQuery, $params);

    if ($updateStmt) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . sqlsrv_errors();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:wght@500;788&display-swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Edit
                            Produk</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="updateForm">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama_produk']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok Produk</label>
                                <input type="text" class="form-control" name="stok" value="<?= htmlspecialchars($data['stok']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
                                <!-- Tombol untuk memunculkan modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmModal">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Update!</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menyimpan perubahan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning" onclick="document.getElementById('updateForm').submit();">Ya, Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrapicons.css" rel="stylesheet">

</body>

</html>
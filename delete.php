<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_produk'] ?? null;
    
    $q = "DELETE FROM Produk WHERE id_produk = ?";
    $stmt = sqlsrv_query($conn, $q, [$id]);

    if ($stmt) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>
        alert('Gagal menghapus produk. Silakan coba lagi.');
        window.location.href = 'index.php';
        </script>";
        exit;
    }
} 

header("Location: index.php");
exit;
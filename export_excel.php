<?php
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=laporan_produk.xls");
    include 'koneksi.php';
    echo "<table border='1'>";
    echo "<tr><th>No</th><th>Nama
    Produk</th><th>Harga</th><th>Stok</th><th>Total</th></tr>";
    $query = "SELECT Nama_Produk, Harga, Stok FROM produk";
    $result = sqlsrv_query($conn, $query);
    $no = 1;
    while ($data = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $total = $data['Harga'] * $data['Stok'];
        echo "<tr>";
        echo "<td>{$no}</td>";
        echo "<td>{$data['Nama_Produk']}</td>";
        echo "<td>{$data['Harga']}</td>";
        echo "<td>{$data['Stok']}</td>";
        echo "<td>{$total}</td>";
        echo "</tr>";
        $no++;
    }
    echo "</table>";
    exit;

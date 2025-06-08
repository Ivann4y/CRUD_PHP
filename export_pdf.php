<?php
require_once('TCPDF-main/tcpdf.php');
include 'koneksi.php';

// Ambil data produk
$query = "SELECT Nama_Produk, Harga, Stok FROM produk";
$result = sqlsrv_query($conn, $query);

// Siapkan HTML untuk laporan
$html = '<h2>Laporan Produk</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Total</th>
            </tr>
        </thead>
    <tbody>';

    $no = 1;
    $totalSemua = 0;

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $total = $row['Harga'] * $row['Stok'];
        $totalSemua += $total;
        $html .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . htmlspecialchars($row['Nama_Produk']) . '</td>
                <td>Rp' . number_format($row['Harga'], 0, ',', '.') . '</td>
                <td>' . $row['Stok'] . '</td>
                <td>Rp' . number_format($total, 0, ',', '.') . '</td>
            </tr>';
    }

    $html .= '</tbody>
        <tfoot>
            <tr>
                <td colspan="4" align="right"><strong>Total Keseluruhan</strong></td>
                <td><strong>Rp' . number_format($totalSemua, 0, ',', '.') . '</strong></td>
            </tr>
        </tfoot>
    </table>';

    // Buat objek TCPDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator('Laporan Produk');
    $pdf->SetTitle('Laporan Produk');
    $pdf->AddPage();
    // Tulis HTML ke PDF
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('Laporan_Produk.pdf', 'I'); // tampil di browser

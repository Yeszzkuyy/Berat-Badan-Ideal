<?php
require('fpdf/fpdf.php');

// Membuat instance FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Menambahkan header
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'Panduan Berat Badan Ideal', 0, 1, 'C');

// Menambahkan konten
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10); // memberi jarak
$pdf->MultiCell(0, 10, "Panduan ini berisi informasi tentang cara menghitung berat badan ideal dan cara mengetahui status berat badan (ideal, kegemukan, kurus). Untuk menghitung berat badan ideal, gunakan rumus: Berat Ideal = Tinggi Badan - 100 - (Tinggi Badan - 100) * 10%\n\nBerat badan ideal harus sesuai dengan tinggi badan dan usia seseorang.\n\nStatus berat badan dapat digolongkan dalam 3 kategori:\n1. Ideal\n2. Kegemukan\n3. Kurus\n\n");

$pdf->Ln(10);
$pdf->Cell(200, 10, 'Terima Kasih!', 0, 1, 'C');

// Output PDF ke browser
$pdf->Output('D', 'Panduan_Berat_Badan_Ideal.pdf');
?>

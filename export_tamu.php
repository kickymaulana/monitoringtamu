<?php
require('fpdf/fpdf.php'); // pastikan path sesuai lokasi FPDF

include 'koneksi.php';

// Ambil data tamu
$result = $koneksi->query("SELECT * FROM tamu_log ORDER BY waktu DESC");

// Inisialisasi PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// Judul
$pdf->Cell(0,10,'Laporan Data Tamu',0,1,'C');
$pdf->Ln(5);

// Header tabel
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(0, 170, 50); // background hijau
$pdf->SetTextColor(255,255,255); // teks putih
$pdf->Cell(10,10,'No',1,0,'C',true);
$pdf->Cell(50,10,'Waktu',1,0,'C',true);
$pdf->Cell(50,10,'Nama',1,0,'C',true);
$pdf->Cell(50,10,'Foto',1,1,'C',true);

// Isi tabel
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$no = 1;
while($row = $result->fetch_assoc()){
    $pdf->Cell(10,25,$no++,1,0,'C');
    $pdf->Cell(50,25,$row['waktu'],1,0,'C');
    $pdf->Cell(50,25,$row['nama'],1,0,'C');
    
    // Cek apakah file foto ada
    $foto_path = 'uploads/'.$row['foto'];
    if(file_exists($foto_path)){
        $pdf->Cell(50,25,$pdf->Image($foto_path,$pdf->GetX(),$pdf->GetY(),20,20),'1',1,'C');
    } else {
        $pdf->Cell(50,25,'-',1,1,'C');
    }
}

$pdf->Output('D','Laporan_Data_Tamu.pdf'); // langsung download
?>

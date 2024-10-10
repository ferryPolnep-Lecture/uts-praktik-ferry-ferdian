<?php
include 'koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Kueri DELETE data
$sql = "DELETE FROM krs WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Data KRS berhasil dihapus.<br>";
    echo "<a href='read.php'>Kembali ke daftar</a>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
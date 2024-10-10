<?php
include 'koneksi.php';

// membuat database
$sql = "CREATE DATABASE IF NOT EXISTS uts5a";
if ($conn->query($sql) === TRUE) {
    echo "Database berhasil dibuat atau sudah ada.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// pilih database
$conn->select_db($dbname);

// membuat tabel
$sql = "CREATE TABLE IF NOT EXISTS krs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    nim CHAR(10) NOT NULL,
    kelas ENUM('5A', '5B', '5C', '5D', '5E') NOT NULL,
    mata_kuliah_pilihan VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel krs berhasil dibuat atau sudah ada.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>
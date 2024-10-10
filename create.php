<?php
include 'koneksi.php';

// Ambil data dari form
$nama = $_POST['name'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];
$makul = isset($_POST['makul']) ? implode(", ", $_POST['makul']) : "";

// Validasi input
$error = "";
if (empty($nama) || empty($nim) || empty($kelas) || empty($makul)) {
    $error .= "Semua field wajib diisi.<br>";
}
if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
    $error .= "Nama hanya boleh berisi huruf.<br>";
}
if (!filter_var($nim, FILTER_VALIDATE_INT) || strlen($nim) != 10) {
    $error .= "NIM harus berisi 10 digit angka.<br>";
}

if (empty($error)) {
    // Kueri INSERT data
    $sql = "INSERT INTO krs (nama, nim, kelas, mata_kuliah_pilihan) 
            VALUES ('$nama', '$nim', '$kelas', '$makul')";

    if ($conn->query($sql) === TRUE) {
        echo "Data KRS berhasil disimpan.<br>";
        echo "<a href='read.php'>Lihat Data</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo $error;
    echo "<br><a href='form_buat_krs.php'>Kembali ke form</a>";
}

$conn->close();
?>
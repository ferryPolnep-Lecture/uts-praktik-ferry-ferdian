<?php
include 'koneksi.php';

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data berdasarkan ID
    $sql = "SELECT * FROM krs WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Jika data tidak ditemukan
    if (!$row) {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Cek apakah form disubmit untuk update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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
        // Kueri UPDATE data
        $sql = "UPDATE krs SET nama='$nama', nim='$nim', kelas='$kelas', mata_kuliah_pilihan='$makul' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Data KRS berhasil diperbarui.<br>";
            echo "<a href='read.php'>Lihat Data</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo $error;
        echo "<br><a href='update.php?id=$id'>Kembali ke form</a>";
    }

    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data KRS</title>
</head>
<body>
    <h2>Edit Data KRS</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label for="name">Nama Mahasiswa:</label>
        <input type="text" name="name" value="<?php echo $row['nama']; ?>" required pattern="[A-Za-z ]+" title="Nama hanya boleh berisi huruf"><br><br>
        
        <label for="nim">NIM:</label>
        <input type="text" name="nim" value="<?php echo $row['nim']; ?>" required pattern="\d{10}" title="NIM harus berisi 10 digit angka"><br><br>
        
        <label for="kelas">Kelas:</label>
        <select name="kelas" required>
            <option value="5A" <?php if ($row['kelas'] == '5A') echo 'selected'; ?>>5A</option>
            <option value="5B" <?php if ($row['kelas'] == '5B') echo 'selected'; ?>>5B</option>
            <option value="5C" <?php if ($row['kelas'] == '5C') echo 'selected'; ?>>5C</option>
            <option value="5D" <?php if ($row['kelas'] == '5D') echo 'selected'; ?>>5D</option>
            <option value="5E" <?php if ($row['kelas'] == '5E') echo 'selected'; ?>>5E</option>
        </select><br><br>
        
        <label for="makul">Mata Kuliah Pilihan:</label><br>
        <?php
        $makul_selected = explode(", ", $row['mata_kuliah_pilihan']);
        $makul_options = [
            "Web Application Development",
            "Mobile Application Development",
            "UI/UX Design",
            "Software Engineering",
            "Data Engineering"
        ];
        foreach ($makul_options as $makul) {
            $checked = in_array($makul, $makul_selected) ? 'checked' : '';
            echo "<input type='checkbox' name='makul[]' value='$makul' $checked> $makul<br>";
        }
        ?><br>
        
        <input type="submit" value="Update">
    </form>
    <br>
    <a href="read.php">Kembali ke daftar</a>
</body>
</html>
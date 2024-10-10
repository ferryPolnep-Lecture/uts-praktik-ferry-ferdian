<?php
include 'koneksi.php';

$sql = "SELECT * FROM krs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Kelas</th>
            <th>Mata Kuliah Pilihan</th>
            <th>Aksi</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['nama']."</td>
            <td>".$row['nim']."</td>
            <td>".$row['kelas']."</td>
            <td>".$row['mata_kuliah_pilihan']."</td>
            <td>
                <a href='update.php?id=".$row['id']."'>Edit</a> | 
                <a href='delete.php?id=".$row['id']."'>Hapus</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data.";
}

$conn->close();
?>
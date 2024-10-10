<!DOCTYPE html>
<html>
<head>
    <title>Input KRS Mahasiswa</title>
</head>
<body>
    <h2>Form Input KRS</h2>
    <form action="create.php" method="POST">
        <label for="name">Nama Mahasiswa:</label>
        <input type="text" name="name" required pattern="[A-Za-z ]+" title="Nama hanya boleh berisi huruf"><br><br>
        
        <label for="nim">NIM:</label>
        <input type="text" name="nim" required pattern="\d{10}" title="NIM harus berisi 10 digit angka"><br><br>
        
        <label for="kelas">Kelas:</label>
        <select name="kelas" required>
            <option value="5A">5A</option>
            <option value="5B">5B</option>
            <option value="5C">5C</option>
            <option value="5D">5D</option>
            <option value="5E">5E</option>
        </select><br><br>
        
        <label for="makul">Mata Kuliah Pilihan:</label><br>
        <input type="checkbox" name="makul[]" value="Web Application Development"> Web Application Development<br>
        <input type="checkbox" name="makul[]" value="Mobile Application Development"> Mobile Application Development<br>
        <input type="checkbox" name="makul[]" value="UI/UX Design"> UI/UX Design<br>
        <input type="checkbox" name="makul[]" value="Software Engineering"> Software Engineering<br>
        <input type="checkbox" name="makul[]" value="Data Engineering"> Data Engineering<br><br>
        
        <input type="submit" value="Simpan">
    </form>
    <br>
    <a href="read.php">Lihat Data</a>
</body>
</html>
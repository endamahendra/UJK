<?php
    $fileJson = 'mahasiswa.json';

    function bacaDataJson($fileJson) {
        if (!file_exists($fileJson)) {
            return [];
        }
        $data = file_get_contents($fileJson);
        return json_decode($data, true) ?? [];
    }

    function simpanDataJson($fileJson, $data) {
        file_put_contents($fileJson, json_encode($data, JSON_PRETTY_PRINT));
    }

    function tambahMahasiswa(&$mahasiswa, $npm, $nama, $tempat_lahir, $tanggal_lahir, $prodi) {
        $mahasiswa[] = [
            'npm' => $npm,
            'nama' => $nama,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'prodi' => $prodi
        ];
    }

    function hapusMahasiswa(&$mahasiswa, $npm) {
        foreach ($mahasiswa as $index => $mhs) {
            if ($mhs['npm'] === $npm) {
                unset($mahasiswa[$index]);
                return true;
            }
        }
        return false;
    }

    $mahasiswa = bacaDataJson($fileJson);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['tambah'])) {
            $npm = $_POST['npm'];
            $nama = $_POST['nama'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $prodi = $_POST['prodi'];

            tambahMahasiswa($mahasiswa, $npm, $nama, $tempat_lahir, $tanggal_lahir, $prodi);
            simpanDataJson($fileJson, $mahasiswa);
        } elseif (isset($_POST['hapus'])) {
            $npm = $_POST['hapus_npm'];
            hapusMahasiswa($mahasiswa, $npm);
            simpanDataJson($fileJson, $mahasiswa);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        form { margin-bottom: 20px; }
        input, button { padding: 8px; margin: 5px 0; }
        button { background-color: #007BFF; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h2>Data Mahasiswa</h2>

<form method="POST">
    <h3>Tambah Mahasiswa</h3>
    <input type="text" name="npm" placeholder="NPM" required>
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required>
    <input type="date" name="tanggal_lahir" required>
    <input type="text" name="prodi" placeholder="Program Studi" required>
    <button type="submit" name="tambah">Tambah</button>
</form>

<table>
    <thead>
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Program Studi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($mahasiswa)): ?>
            <tr><td colspan="6">Tidak ada data mahasiswa.</td></tr>
        <?php else: ?>
            <?php foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?= htmlspecialchars($mhs['npm']) ?></td>
                    <td><?= htmlspecialchars($mhs['nama']) ?></td>
                    <td><?= htmlspecialchars($mhs['tempat_lahir']) ?></td>
                    <td><?= htmlspecialchars($mhs['tanggal_lahir']) ?></td>
                    <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="hapus_npm" value="<?= htmlspecialchars($mhs['npm']) ?>">
                            <button type="submit" name="hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

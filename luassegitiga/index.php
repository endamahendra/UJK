<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Luas Alas Segitiga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Hitung Luas Alas Segitiga</h2>

<form method="POST">
    <label for="alas">Masukkan Alas (cm):</label>
    <input type="number" id="alas" name="alas" step="0.01" required>

    <label for="tinggi">Masukkan Tinggi (cm):</label>
    <input type="number" id="tinggi" name="tinggi" step="0.01" required>

    <button type="submit" name="hitung">Hitung Luas</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alas = isset($_POST['alas']) ? floatval($_POST['alas']) : 0;
    $tinggi = isset($_POST['tinggi']) ? floatval($_POST['tinggi']) : 0;

    if ($alas > 0 && $tinggi > 0) {
        $luas = 0.5 * $alas * $tinggi;
        echo "<div class='result'>Luas alas segitiga adalah: $luas cm<sup>2</sup></div>";
    } else {
        echo "<div class='result'>Alas dan tinggi harus bernilai positif!</div>";
    }
}
?>

</body>
</html>

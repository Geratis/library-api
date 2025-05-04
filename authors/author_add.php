<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';

    if ($first_name && $last_name) {
        $stmt = $pdo->prepare("INSERT INTO authors (first_name, last_name) VALUES (?, ?)");
        $stmt->execute([$first_name, $last_name]);
        header("Location: /biblioteka/author");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dodaj autora</title>
    <link rel="stylesheet" href="/biblioteka/style.css">
</head>
<body>
<h2>Dodaj autora</h2>
<form method="post">
    <label>Imię:</label>
    <input type="text" name="first_name" required>
    <label>Nazwisko:</label>
    <input type="text" name="last_name" required>
    <input type="submit" value="Dodaj autora">
</form>
<div class="center">
  <a href="/biblioteka/author">Wróć</a>
</div>
</body>
</html>
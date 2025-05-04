<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit("Brak ID");

$author = $pdo->prepare("SELECT * FROM authors WHERE id = ?");
$author->execute([$id]);
$author = $author->fetch();

if (!$author) exit("Nie znaleziono autora");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';

    $stmt = $pdo->prepare("UPDATE authors SET first_name = ?, last_name = ? WHERE id = ?");
    $stmt->execute([$first_name, $last_name, $id]);
    header("Location: /biblioteka/author"); 
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edytuj autora</title>
    <link rel="stylesheet" href="/biblioteka/style.css">
</head>
<body>
<h2>Edytuj autora</h2>
<form method="post">
    <label>Imię:</label>
    <input type="text" name="first_name" value="<?= htmlspecialchars($author['first_name']) ?>" required>
    <label>Nazwisko:</label>
    <input type="text" name="last_name" value="<?= htmlspecialchars($author['last_name']) ?>" required>
    <input type="submit" value="Zapisz">
</form>
<div class="center">
  <a href="/biblioteka/author">Wróć</a> 
</div>
</body>
</html>

<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Brak ID książki.";
    exit;
}

$stmt = $pdo->prepare("SELECT books.*, authors.first_name, authors.last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if (!$book) {
    echo "Książka nie znaleziona.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły książki</title>
    <link rel="stylesheet" href="/biblioteka/style.css">
</head>
<body>
  <h2><?= htmlspecialchars($book['title']) ?></h2>
  <div class="div-center">
    <p><strong>Autor:</strong> <?= htmlspecialchars($book['first_name'] . ' ' . $book['last_name']) ?></p>
    <p><strong>Gatunek:</strong> <?= htmlspecialchars($book['genre']) ?></p>
    <p><strong>Rok wydania:</strong> <?= htmlspecialchars($book['published_year']) ?></p>
  </div>
    <div class="center">
      <a href="/biblioteka/book">Wróć do listy książek</a>
    </div>
</body>
</html>

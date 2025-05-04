<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Brak ID";
    exit;
}

$stmt = $pdo->prepare("SELECT books.*, authors.first_name, authors.last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if (!$book) {
    echo "Książka nie znaleziona";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Książka</title><link rel="stylesheet" href="/biblioteka/style.css"></head>
<body>
<h2><?= htmlspecialchars($book['title']) ?></h2>
<p><strong>Autor:</strong> <?= htmlspecialchars($book['first_name'] . ' ' . $book['last_name']) ?></p>
<p><strong>Gatunek:</strong> <?= htmlspecialchars($book['genre']) ?></p>
<p><strong>Rok wydania:</strong> <?= htmlspecialchars($book['published_year']) ?></p>
<a class="button" href="/biblioteka/books">&larr; Wstecz</a>
</body>
</html>
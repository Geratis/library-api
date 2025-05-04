<?php
require '../db.php';

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM authors WHERE id = ?");
$stmt->execute([$id]);
$author = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły autora</title>
    <link rel="stylesheet" href="/biblioteka/style.css">
</head>
<body>
    <h1>Szczegóły autora</h1>
    <div class="div-center">

      <p><strong>Imię:</strong> <?= htmlspecialchars($author['first_name']) ?></p>
      <p><strong>Nazwisko:</strong> <?= htmlspecialchars($author['last_name']) ?></p>
      <p><strong>ID:</strong> <?= htmlspecialchars($author['id']) ?></p>
    </div>
    <div class="center">
      <a href="/biblioteka/author">Wróć do listy autorów</a>
    </div>
</body>
</html>

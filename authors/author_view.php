<?php
require '../db.php';

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM authors WHERE id = ?");
$stmt->execute([$id]);
$author = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head><title>Autor</title><link rel="stylesheet" href="/biblioteka/style.css"></head>
<body>
<h2><?= htmlspecialchars($author['first_name'] . ' ' . $author['last_name']) ?></h2>
<a class="button" href="/author">&larr; Wstecz</a>
</body>
</html>
<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author_id = $_POST['author_id'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $published_year = $_POST['published_year'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO books (title, author_id, genre, published_year) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $author_id, $genre, $published_year]);

    header("Location: /biblioteka/book");
    exit;
}

$authors = $pdo->query("SELECT * FROM authors")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj książkę</title>
    <link rel="stylesheet" href="/biblioteka/style.css">
</head>
<body>
    <h2>Dodaj książkę</h2>
    <form method="post">
        <label>Tytuł:</label>
        <input type="text" name="title" required>
        <label>Autor:</label>
        <select name="author_id">
            <?php foreach ($authors as $author): ?>
                <option value="<?= $author['id'] ?>"><?= $author['first_name'] . ' ' . $author['last_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <label>Gatunek:</label>
        <input type="text" name="genre" required>
        <label>Rok wydania:</label>
        <input type="text" name="published_year" required>
        <input type="submit" value="Dodaj książkę">
    </form>
    <div class="center">
        <a href="/biblioteka/book">Wróć do listy książek</a>
    </div>
</body>
</html>

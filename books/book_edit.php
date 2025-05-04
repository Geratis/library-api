<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit("Brak ID");

$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if (!$book) exit("Książka nie znaleziona");


$stmt = $pdo->query("SELECT * FROM authors");
$authors = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author_id = $_POST['author_id'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $published_year = $_POST['published_year'] ?? '';

    $stmt = $pdo->prepare("UPDATE books SET title = ?, author_id = ?, genre = ?, published_year = ? WHERE id = ?");
    $stmt->execute([$title, $author_id, $genre, $published_year, $id]); // 🛠️ Dodano brakujące $id
    header("Location: /biblioteka/book");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj książkę</title>
    <link rel="stylesheet" href="/biblioteka/style.css">
</head>
<body>
    <h2>Edytuj książkę</h2>
    <form method="post">
        <label>Tytuł:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>

        <label>Autor:</label>
        <select name="author_id" required>
            <?php foreach ($authors as $author): ?>
                <option value="<?= $author['id'] ?>" <?= $author['id'] == $book['author_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($author['first_name'] . ' ' . $author['last_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Gatunek:</label>
        <input type="text" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required>

        <label>Rok wydania:</label>
        <input type="text" name="published_year" value="<?= htmlspecialchars($book['published_year']) ?>" required>

        <input type="submit" value="Zapisz">
    </form>

    <div class="center">
        <a href="/biblioteka/book">Wróć do listy książek</a>
    </div>
</body>
</html>

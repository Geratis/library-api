<?php
require '../db.php';

$stmt = $pdo->query("SELECT books.id, books.title, books.genre, books.published_year, authors.first_name, authors.last_name 
                     FROM books 
                     JOIN authors ON books.author_id = authors.id 
                     ORDER BY books.id");
$books = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista książek</title>
    <link rel="stylesheet" href="/biblioteka/style.css">
</head>
<body>
<h1><a href = "/biblioteka">Biblioteka</a></h1>
<h2 class="center">Lista książek</h2>
<div class="center">
    <a class="button" href="/biblioteka/book/addBook">Dodaj książkę</a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Tytuł</th>
        <th>Autor</th>
        <th>Gatunek</th>
        <th>Rok wydania</th>
        <th>Akcje</th>
    </tr>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><?= $book['id'] ?></td>
            <td><?= htmlspecialchars($book['title']) ?></td>
            <td><?= htmlspecialchars($book['first_name'] . ' ' . $book['last_name']) ?></td>
            <td><?= htmlspecialchars($book['genre']) ?></td>
            <td><?= htmlspecialchars($book['published_year']) ?></td>
            <td>
                <a href="/biblioteka/book/<?= $book['id'] ?>/details">Szczegóły</a> |
                <a href="/biblioteka/book/updateBook/<?= $book['id'] ?>" class="edit-link">Edytuj</a> |
                <a href="/biblioteka/book/deleteBook/<?= $book['id'] ?>" class="delete-link">Usuń</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

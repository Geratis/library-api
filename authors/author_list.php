<?php
require '../db.php';

$stmt = $pdo->query("SELECT * FROM authors");
$authors = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Autorów</title>
    <link rel="stylesheet" href="/biblioteka/style.css"> 
</head>
<body>
<h1><a href = "/biblioteka">Biblioteka</a></h1>
    <h2>Lista Autorów</h2>
    <div class="center">
        <a href="/biblioteka/author/addAuthor">Dodaj nowego autora</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authors as $author): ?>
                <tr>
                    <td><?= htmlspecialchars($author['id']) ?></td>
                    <td><?= htmlspecialchars($author['first_name']) ?></td>
                    <td><?= htmlspecialchars($author['last_name']) ?></td>
                    <td>
                        <a href="/biblioteka/author/<?= $author['id'] ?>/details">Szczegóły</a> |
                        <a href="/biblioteka/author/updateAuthor/<?= $author['id'] ?>">Edytuj</a> |
                        <a href="/biblioteka/author/deleteAuthor/<?= $author['id'] ?>">Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="center">
  <a href="/biblioteka">Wróć</a> 
</div>
    
</body>
</html>

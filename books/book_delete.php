<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit("Brak ID książki");

$stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
$stmt->execute([$id]);

header("Location: /biblioteka/book");
exit;

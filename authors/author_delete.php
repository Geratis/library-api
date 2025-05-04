<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit("Brak ID");


$stmt = $pdo->prepare("DELETE FROM books WHERE author_id = ?");
$stmt->execute([$id]);


$stmt = $pdo->prepare("DELETE FROM authors WHERE id = ?");
$stmt->execute([$id]);

header("Location: /biblioteka/author");  
exit;
?>

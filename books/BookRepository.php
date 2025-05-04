<?php
class BookRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllBooksWithAuthors() {
        $stmt = $this->pdo->query("SELECT books.id, books.title, books.genre, books.published_year, authors.first_name, authors.last_name 
                                   FROM books 
                                   JOIN authors ON books.author_id = authors.id 
                                   ORDER BY books.id");
        return $stmt->fetchAll();
    }
}

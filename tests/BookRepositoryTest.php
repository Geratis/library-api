<?php

use PHPUnit\Framework\TestCase;

class BookRepositoryTest extends TestCase
{
    protected $pdo;
    protected $authorId;

    
    protected function setUp(): void
    {
        
        $this->pdo = new PDO('mysql:host=localhost;dbname=biblioteka', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $this->pdo->exec("DELETE FROM books");
        $this->pdo->exec("DELETE FROM authors");

        
        $authorStmt = $this->pdo->prepare("INSERT INTO authors (first_name, last_name) VALUES (?, ?)");
        $authorStmt->execute(['John', 'Doe']);
        $this->authorId = $this->pdo->lastInsertId(); // Pobranie ID autora
    }

    
    protected function tearDown(): void
    {
        
        $this->pdo->exec("DELETE FROM books");
        $this->pdo->exec("DELETE FROM authors");
    }

    // Test dodawania książki
    public function testBookInsert()
    {
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author_id) VALUES (?, ?)");
        $stmt->execute(['Test Book', $this->authorId]);
        
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE title = ?");
        $stmt->execute(['Test Book']);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotNull($book);
        $this->assertEquals('Test Book', $book['title']);
        $this->assertEquals($this->authorId, $book['author_id']);
    }

    // Test aktualizacji książki
    public function testBookUpdate()
    {
        
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author_id) VALUES (?, ?)");
        $stmt->execute(['Test Book', $this->authorId]);
        $bookId = $this->pdo->lastInsertId();

        
        $stmt = $this->pdo->prepare("UPDATE books SET title = ? WHERE id = ?");
        $stmt->execute(['Updated Book', $bookId]);

        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$bookId]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotNull($book);
        $this->assertEquals('Updated Book', $book['title']);
    }

    // Test usunięcia książki
    public function testBookDelete()
    {
        
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author_id) VALUES (?, ?)");
        $stmt->execute(['Test Book', $this->authorId]);
        $bookId = $this->pdo->lastInsertId();

        
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
        $stmt->execute([$bookId]);

        
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$bookId]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertFalse($book); 
    }

    // Test pobierania książek
    public function testGetBooks()
    {
        
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author_id) VALUES (?, ?)");
        $stmt->execute(['Test Book', $this->authorId]);

        $stmt = $this->pdo->prepare("SELECT * FROM books");
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($books); 
    }

    // Test niepoprawnego dodania książki (brak tytułu)
    public function testInvalidBookAdd()
    {
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author_id) VALUES (?, ?)");
        $this->expectException(PDOException::class); 
        $stmt->execute([null, $this->authorId]); 
    }
}

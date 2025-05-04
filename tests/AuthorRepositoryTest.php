<?php
// php vendor/bin/phpunit --testdox tests/BookRepositoryTest.php
// php vendor/bin/phpunit --testdox tests/AuthorRepositoryTest.php

use PHPUnit\Framework\TestCase;

class AuthorRepositoryTest extends TestCase
{
    protected $pdo;

    
    protected function setUp(): void
    {
        
        $this->pdo = new PDO('mysql:host=localhost;dbname=biblioteka', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $this->pdo->exec("DELETE FROM authors");
    }

    
    protected function tearDown(): void
    {
        
        $this->pdo->exec("DELETE FROM authors");
    }

    
    public function testAuthorInsert()
    {
        $stmt = $this->pdo->prepare("INSERT INTO authors (first_name, last_name) VALUES (?, ?)");
        $stmt->execute(['John', 'Doe']);

        $stmt = $this->pdo->prepare("SELECT * FROM authors WHERE first_name = ?");
        $stmt->execute(['John']);
        $author = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotNull($author);
        $this->assertEquals('John', $author['first_name']);
        $this->assertEquals('Doe', $author['last_name']);
    }

   
    public function testAuthorUpdate()
    {
        
        $stmt = $this->pdo->prepare("INSERT INTO authors (first_name, last_name) VALUES (?, ?)");
        $stmt->execute(['John', 'Doe']);
        $authorId = $this->pdo->lastInsertId();

       
        $stmt = $this->pdo->prepare("UPDATE authors SET first_name = ?, last_name = ? WHERE id = ?");
        $stmt->execute(['Jane', 'Smith', $authorId]);

        $stmt = $this->pdo->prepare("SELECT * FROM authors WHERE id = ?");
        $stmt->execute([$authorId]);
        $author = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotNull($author);
        $this->assertEquals('Jane', $author['first_name']);
        $this->assertEquals('Smith', $author['last_name']);
    }

    
    public function testAuthorDelete()
    {
        
        $stmt = $this->pdo->prepare("INSERT INTO authors (first_name, last_name) VALUES (?, ?)");
        $stmt->execute(['John', 'Doe']);
        $authorId = $this->pdo->lastInsertId();

        
        $stmt = $this->pdo->prepare("DELETE FROM authors WHERE id = ?");
        $stmt->execute([$authorId]);

        
        $stmt = $this->pdo->prepare("SELECT * FROM authors WHERE id = ?");
        $stmt->execute([$authorId]);
        $author = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertFalse($author); 
    }

    
    public function testGetAuthors()
    {
        // Dodanie autora
        $stmt = $this->pdo->prepare("INSERT INTO authors (first_name, last_name) VALUES (?, ?)");
        $stmt->execute(['John', 'Doe']);

        $stmt = $this->pdo->prepare("SELECT * FROM authors");
        $stmt->execute();
        $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($authors); 
    }
}

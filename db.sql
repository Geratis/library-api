CREATE DATABASE biblioteka;

-- CREATE TABLE authors (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL
-- );

-- CREATE TABLE books (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     title VARCHAR(255) NOT NULL,
--     author_id INT,
--     FOREIGN KEY (author_id) REFERENCES authors(id)
-- );
CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    first_name VARCHAR(255) NOT NULL,   
    last_name VARCHAR(255) NOT NULL    
);

INSERT INTO authors (first_name, last_name) VALUES
('Jan', 'Frankowski'),
('Robert', 'Lewandowski'),
('Michał', 'Anioł');

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,   
    title VARCHAR(255) NOT NULL,           
    author_id INT,                         
    genre VARCHAR(100),                    
    published_year INT,                    
    FOREIGN KEY (author_id) REFERENCES authors(id)  
);

INSERT INTO books (title, author_id, genre, published_year) VALUES
('Harry Potter', 1, 'Adventure', 2020),
('Władca Piekieł', 2, 'Fantastic', 2019),
('W pustyni i w puszczy', 3, 'History', 2021);
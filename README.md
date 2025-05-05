# <div align="center">Library API System</div>

## 🔧 Wymagania


### Podstawowe

* PHP
* MySQL
* Node.js

### Testowanie

* PHPUnit
* K6
* Cypress

## 🧩 Główne funkcje

### Książki

* Przeglądanie wszystkich książek
* Przeglądanie książek z dodatkowymi danymi o autorze
* Dodawanie nowych książek
* Edycja danych książek
* Usuwanie książek

### Autorzy

* Lista autorów
* Szczegóły autora z jego książkami
* Dodawanie nowych autorów
* Modyfikacja informacji o autorach
* Usuwanie autorów


## 🧪 Technologie
- **Backend:** PHP
- **Database:** MySQL
- **Testing:**
  - PHPUnit: Unit testing
  - Cypress: Frontend testing
  - K6: API Performance testing

### PHPUnit Test

```bash
php vendor/bin/phpunit --testdox tests/BookRepositoryTest.php

php vendor/bin/phpunit --testdox tests/AuthorRepositoryTest.php
```

### Cypress Test

```bash
npx cypress open
```

### K6 Test

```bash
k6 run k6_test.js
```





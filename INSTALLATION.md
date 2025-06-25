# Instrukcje instalacji - User Management System

## Wymagania systemowe
- XAMPP (Apache + MySQL + PHP)
- PHP 7.4 lub nowszy
- MySQL 5.7 lub nowszy

## Krok 1: Uruchomienie XAMPP
1. Uruchom XAMPP Control Panel
2. Kliknij "Start" dla Apache i MySQL
3. Sprawdź czy oba serwisy działają (zielone światło)

## Krok 2: Utworzenie bazy danych
1. Otwórz przeglądarkę i przejdź do: `http://localhost/phpmyadmin/`
2. Kliknij "Nowa" (New) w lewym panelu
3. Wpisz nazwę bazy danych: `test`
4. Kliknij "Utwórz" (Create)

## Krok 3: Import struktury bazy danych
1. W phpMyAdmin wybierz bazę danych `test`
2. Kliknij zakładkę "Import"
3. Kliknij "Wybierz plik" i wybierz `bazadanych.sql`
4. Kliknij "Wykonaj" (Go)

## Krok 4: Konfiguracja połączenia z bazą danych
1. Otwórz plik `config.php`
2. Sprawdź i dostosuj dane logowania:

```php
$host = 'localhost';        // lub '127.0.0.1'
$dbname = 'test';           // nazwa bazy danych
$username = 'root';         // nazwa użytkownika MySQL
$password = '';             // hasło MySQL (puste dla domyślnej instalacji XAMPP)
```

**Ważne:** Dla domyślnej instalacji XAMPP hasło jest puste!

## Krok 5: Test połączenia
1. Otwórz w przeglądarce: `http://localhost/Users_PHP/test_connection.php`
2. Sprawdź czy połączenie jest udane
3. Jeśli są błędy, sprawdź dane logowania w `config.php`

## Krok 6: Uruchomienie aplikacji
1. Otwórz w przeglądarce: `http://localhost/Users_PHP/`
2. Sprawdź czy wszystkie funkcje działają poprawnie

## Rozwiązywanie problemów

### Błąd: "Access denied for user 'root'@'localhost'"
- Sprawdź czy MySQL jest uruchomiony w XAMPP
- Sprawdź dane logowania w `config.php`
- Dla domyślnej instalacji XAMPP hasło jest puste

### Błąd: "Database 'test' doesn't exist"
- Utwórz bazę danych `test` w phpMyAdmin
- Zaimportuj plik `bazadanych.sql`

### Błąd: "Undefined variable $pdo"
- Sprawdź czy plik `config.php` istnieje
- Sprawdź czy funkcja `getDBConnection()` jest dostępna

### Błąd: "Session cannot be started after headers"
- Upewnij się, że `session_start()` jest na początku pliku
- Sprawdź czy nie ma spacji przed `<?php`

## Struktura plików
```
Users_PHP/
├── config.php              # Konfiguracja bazy danych
├── index.php               # Strona główna
├── add_user.php            # Dodawanie użytkowników
├── viewsubscribers.php     # Lista użytkowników
├── subscriber_edit.php     # Edycja użytkowników
├── subscriber_del.php      # Usuwanie użytkowników
├── update_user.php         # Aktualizacja użytkowników
├── widoki.php              # Widoki bazy danych
├── audit.php               # Historia audytu
├── process_data.php        # Przetwarzanie danych
├── bazadanych.sql          # Struktura bazy danych
├── test_connection.php     # Test połączenia
└── INSTALLATION.md         # Ten plik
```

## Funkcje systemu
- ✅ Dodawanie użytkowników
- ✅ Edycja użytkowników
- ✅ Usuwanie użytkowników
- ✅ Lista użytkowników
- ✅ System audytu
- ✅ Widoki bazy danych
- ✅ Responsywny design
- ✅ Walidacja danych
- ✅ Bezpieczne połączenie PDO

## Wsparcie
Jeśli masz problemy z instalacją, sprawdź:
1. Logi błędów w XAMPP
2. Konfigurację w `config.php`
3. Czy wszystkie pliki są w odpowiednim katalogu
4. Czy baza danych została poprawnie zaimportowana 
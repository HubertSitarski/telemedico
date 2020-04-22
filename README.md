# Telemedico - Hubert Sitarski

## 1. Uruchomienie projektu

1. Pobieramy projekt
2. Uruchamiamy `composer install`
3. Kopiujemy zawartość pliku `.env` do pliku `.env.local` i ustawiamy dane bazy danych

## 2. Linki

### Zadanie 1
* Logowanie - `/login`
* Wylogowanie - `/logout`
* Rejestracja - `/register`

### Zadanie 2 i 3
* Logowanie - `/api/login` (POST - należy w jsonie wysłać pola `username` i `password`)
* Wylogowanie - `/api/logout`
* Pobranie listy użytkowników - `/api/users` (GET - wymagana autoryzacja)
* Pobranie użytkownika - `/api/users/get/{id}` (GET - wymagana autoryzacja)
* Dodanie użytkownika - `/api/users/create` (POST - wymagana autoryzacja - pola `email` i `plainPassword`)
* Edycja użytkownika - `/api/users/update/{id}` (PUT - wymagana autoryzacja - pola `email` i `plainPassword`)
* Usunięcie użytkownika - `/api/users/delete/{id}` (DELETE - wymagana autoryzacja) 
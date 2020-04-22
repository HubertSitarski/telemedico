# Telemedico - Hubert Sitarski

## 1. Uruchomienie projektu

1. Pobieramy projekt
2. Uruchamiamy `composer install`
3. Kopiujemy zawartość pliku `.env` do pliku `.env.local` i ustawiamy dane bazy danych
4. Uruchamiamy `php bin/console doctrine:migrations:migrate` lub `php bin/console doctrine:schema:update`

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

## 3. Omówienie

Zgodnie z treścią zadania:

Zadanie 1 - rejestrację i logowanie postanowiłem wykonać w formie webowej. Zadanie oparte na formularzach Symfony i szablonach Twig. Po treści zadania myślę, że o to Państwu chodziło.

Zadanie 2 i 3 - stworzyłem osobny sposób logowania, niż w zadaniu 1 (za pomocą specjalnego endpointu (`api/login`) dedykowanego pod API, z osobnym, customowym Guardem) oraz podstawowego CRUDa związanego z obiektem User. W kontekście rozwijania aplikacji dalej, dodałbym tutaj JWT lub inny, bardziej zaawansowany, sposób autoryzacji, który na pewno podniósłby bezpieczeństwo aplikacji. Natomiast, w związku z ograniczeniem dotyczącym zewnętrznych bundli, zdecydowałem się na obecne rozwiązanie wykorzystujące customowego Guarda i opcje dostarczone przez Symfony.

Ponadto przygotowałem parę rozwiązań do ewentualnego dalszego rozwijania aplikacji. Utworzyłem pliki kumulujące powtarzające się stałe oraz BaseEntity i BaseController, które potem mogłyby pomóc w dalszym tworzeniu analogicznych struktur.

## 4. Wybrane użyte narzędzia

* Symfony 4
* Doctrine
* MySQL 5.6
* symfony/security-bundle
* symfony/serializer-pack
* symfony/twig-bundle
* symfony/validator 
* symfony/form
<?php

class UserRegistration {

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function sanitizeInput(string $input): string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public function register(array &$errors = []): bool
    {
        $username = $this->sanitizeInput(filter_input(INPUT_POST, 'username'));
        $email = $this->sanitizeInput(filter_input(INPUT_POST, 'email'));
        $password = $this->sanitizeInput(filter_input(INPUT_POST, 'password'));
        $passwordRepeat = $this->sanitizeInput(filter_input(INPUT_POST, 'passwordRepeat'));

        $validateUsername = $this->validateUsername($username, $errors);
        $validateEmail = $this->validateEmail($email, $errors);
        $validatePassword = $this->validatePassword($password, $errors);
        $validatePasswordRepeat = $this->validatePasswordRepeat($password, $passwordRepeat, $errors);

        if ($validateUsername && $validateEmail && $validatePassword && $validatePasswordRepeat) {
            $createdAt = time();

            try {
                $query = "INSERT INTO user (username, email, password, created_at) VALUES (:username, :email, :password, :created_at)";
                $statement = $this->db->prepare($query);
                $statement->bindParam(':username', $username);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':password', $hashedPassword);
                $statement->bindParam(':created_at', $createdAt);

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $statement->execute();

                $userId = $this->db->lastInsertId();
                $_SESSION['user_id'] = $userId;

            } catch (PDOException $e) {
                echo "Fehler bei der Datenbankabfrage: " . $e->getMessage();
                exit();
            }
        }

        return $validateUsername && $validateEmail && $validatePassword && $validatePasswordRepeat;
    }


    private function validateUsername(?string $username, array &$errors): bool {

        if (strlen($username) < 4) {
            $errors['username'][] = 'Der Nutzername muss mindestens 4 Zeichen lang sein!';
        } elseif (strlen($username) > 16) {
            $errors['username'][] = 'Der Nutzername darf nicht länger als 16 Zeichen sein.';
        }
        if (!is_null($username) && preg_match('/\s/', $username)) {
            $errors['username'][] = 'Der Nutzername darf keine Leerzeichen enthalten.';
        }

        return !isset($errors['username']);
    }


    private function validateEmail(?string $email, array &$errors): bool {

        if (is_null($email) || empty($email)) {
            $errors['email'][] = 'Dieses Feld muss ausgefüllt werden.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Bitte geben Sie eine gültige EMail-Adresse ein.';
        }

        return !isset($errors['email']);
    }


    private function validatePassword(?string $password, array &$errors): bool {

        if (strlen($password) < 8) {
            $errors['password'][] = 'Das Passwort muss mindestens 8 Zeichen lang sein!';
        }
        if (!preg_match('/[a-z]/', $password)) {
            $errors['password'][] = 'Das Passwort muss mindestens einen kleinen Buchstaben enthalten.';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors['password'][] = 'Das Passwort muss mindestens einen großen Buchstaben enthalten.';
        }
        if (!preg_match('/\d/', $password)) {
            $errors['password'][] = 'Das Passwort muss mindestens eine Zahl enthalten.';
        }
        if (!preg_match('/\W/', $password)) {
            $errors['password'][] = 'Das Passwort muss mindestens ein Sonderzeichen enthalten.';
        }
        if (preg_match('/\s/', $password)) {
            $errors['password'][] = 'Das Passwort darf keine Leerzeichen enthalten.';
        }

        return !isset($errors['password']);
    }


    private function validatePasswordRepeat(string $password = null, string $passwordRepeat = null, array &$errors): bool {

        if (empty($passwordRepeat)) {
            $errors['passwordRepeat'][] = 'Bitte wiederholen Sie Ihr Passwort.';
            return false;
        }

        if ($password !== $passwordRepeat) {
            $errors['passwordRepeat'][] = 'Die Passwörter stimmen nicht überein.';
            return false;
        }

        return !isset($errors['passwordRepeat']);
    }
}

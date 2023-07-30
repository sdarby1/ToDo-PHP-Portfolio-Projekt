<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . 'path.php';
include_once convertToUnixPath(__DIR__ . '/../templates/header-and-footer/header.php');

class UserLogin {

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function sanitizeInput(string $input): string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public function login(array &$errors = []): bool
    {
        $username = $this->sanitizeInput(filter_input(INPUT_POST, 'username'));
        $password = $this->sanitizeInput(filter_input(INPUT_POST, 'password'));

    
        try {
            $query = "SELECT COUNT(*) FROM user WHERE username = :username";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':username', $username);
            $statement->execute();
            $userExists = (bool)$statement->fetchColumn();

            if (!$userExists) {
                $errors['username'][] = 'Dieser Benutzer existiert nicht.';
                return false;
            }
        } catch (PDOException $e) {
            echo "Fehler bei der Datenbankabfrage: " . $e->getMessage();
            exit();
        }

        try {
            $query = "SELECT * FROM user WHERE username = :username";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':username', $username);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            } else {
                $errors['password'][] = 'Das eingegebene Passwort ist falsch.';
                return false;
            }
        } catch (PDOException $e) {
            echo "Fehler bei der Datenbankabfrage: " . $e->getMessage();
            exit();
        }
    }
}

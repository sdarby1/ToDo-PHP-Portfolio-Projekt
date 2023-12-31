<?php

namespace App\Models;

use App\Helpers\Str;
use App\Helpers\Session;
use App\Helpers\Exception;

use App\Traits\RepresentsDatabaseEntry;

class User {
    use RepresentsDatabaseEntry;

    private string $id;
    private string $username;
    private string $email;
    private string $password;
    private string $joinedAt;

    public function __construct(private Database $db)
    {}

    public function find(int|string $identifier = null): bool
    {
        $identifier = $identifier ?? Session::get('userId');
        $column = is_int($identifier) ? 'id' : 'username';

        $sql = "SELECT * FROM `users` WHERE `{$column}` = :identifier";
        $userQuery = $this->db->query($sql, [ 'identifier' => $identifier ]);

        if ($userQuery->rowCount() === 0) {
            return false;
        }

        $userData = $userQuery->results()[0];
        $this->setColumnsAsProperties($userData);

        return true;
    }

    public function register(string $username, string $email, string $password): void
    {

        $sql = "SELECT 1 FROM `users` WHERE `username` = :username OR `email` = :email";

        $statement = $this->db->query($sql, [ 'username' => $username, 'email' => $email ]);

        if ($statement->rowCount() > 0) {
            throw new Exception("❌ Der Account existiert bereits.");
        }

        $sql = "
            INSERT INTO `users`
            (`username`, `email`, `password`, `joined_at`)
            VALUES (:username, :email, :password, :joined_at)
        ";

        $passwordHash = password_hash($password, PASSWORD_DEFAULT, [
            'cost' => 11
        ]);

        $statement = $this->db->query($sql, [
            'username' => $username,
            'email' => $email,
            'password' => $passwordHash,
            'joined_at' => time()
        ]);
    }

    public function login(string $username, string $password)
    {

        if (!$this->find($username)) {
            throw new Exception(data: [ 'username' => ['❌ Der Nutzername konnte nicht gefunden werden.'] ]);
        }

        $passwordHash = $this->password;

        if (!password_verify($password, $passwordHash)) {
            throw new Exception(data: ['password' => ["❌ Falsches Passwort."] ]);
        }


        Session::set('userId', (int) $this->id);
    }

    public function isLoggedIn(): bool
    {
        return Session::exists('userId');
    }

    public function logout(): void
    {
        Session::delete('userId');
    }

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getPosts(): array
    {
        $sql = "SELECT * FROM `posts` WHERE `user_id` = :userId";
        $postsQuery = $this->db->query($sql, [ 'userId' => $this->getId() ]);

        $posts = [];

        foreach ($postsQuery->results() as $result) {
            $posts[] = new Post($this->db, $result);
        }

        return $posts;
    }

    public function owns(Post $model): bool
    {
        return $this->getId() === $model->getUserId();
    }
}

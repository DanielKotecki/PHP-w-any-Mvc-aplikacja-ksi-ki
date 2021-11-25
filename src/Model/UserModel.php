<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use PDOException;

class UserModel extends AbstractModel
{
    //Rejestracja
    public function register(string $username, string $email, string $password)
    {
        try {
            $password_hash = password_hash($password, PASSWORD_ARGON2I);
            $queryInsert = "INSERT into user_table (username,email,password) VALUES('{$username}','{$email}','{$password_hash}')";
            $result = $this->connection->exec($queryInsert);
            dump('try' . $result);
        } catch (PDOException $th) {
            dump("th:" . $th->getMessage());
            exit;
        }
    }
    //Logowanie
    public function login(string $email, string  $password): array
    {
        $queryUser = "SELECT * FROM user_table WHERE email='{$email}' Limit 1";
        $result = $this->connection->query($queryUser);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            $ver = password_verify($password, $user['password']);
            if ($ver) {
                $user['type'] = true;
                unset($user['password']);
                return $user;
            }
        }

        return [
            'emailError' => 'Nieprawidłowy email lub hasło',
            'passwordError' => 'Nieprawidłowy email lub hasło',
            'type' => false
        ];
    }
    //sprawdzenie czy istnieje o podanej nazwie, emailu
    public function check($param_to_check, string $where_check): bool
    {
        $queryCheck = "SELECT 'username' from user_table Where {$where_check}='{$param_to_check}'";
        $result = $this->connection->query($queryCheck);
        $result = $result->fetch(PDO::FETCH_ASSOC);

        if ($result == null) {
            return false;
        }
        return true;
    }
}

<?php

class User
{
    // DB prop
    private $conn;
    private $table = 'users';

    // User prop
    private $id;
    private $username;
    private $email;
    private $password;
    private $height;
    private $weight;
    private $gender;
    private $profile_pic;
    private $user_closed;
    private $created_at;
    private $updated_at;

    // DB __constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hash password
    public function hash_password($pass) {
        return $this->password = password_hash($pass, PASSWORD_BCRYPT);
    }
}

<?php

class User
{
    // DB prop
    private $conn;
    private $table = 'users';

    // User prop
    public $id;
    public $username;
    public $email;
    public $password;
    public $height = 0;
    public $weight = 0;
    public $gender;
    public $profile_pic;
    public $user_closed;
    public $created_at;
    public $updated_at;

    // DB __constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hash password
    public function hash_password($pass)
    {
        return $this->password = password_hash($pass, PASSWORD_BCRYPT);
    }

    // Check if email exists
    public function check_email_unique($email)
    {
        // Create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind email
        $stmt->bindParam(':email', $email);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Check if username exists
    public function check_username_unique($username)
    {
        // Create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE username= :username LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind username
        $stmt->bindParam(':username', $username);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create user
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
                    SET
                        username= :username,
                        email= :email,
                        password= :password,
                        height= :height,
                        weight= :weight,
                        gender= :gender,
                        profile_pic= :profile_pic,
                        user_closed= :user_closed,
                        created_at= :created_at,
                        updated_at= :updated_at
                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->username = h(st($this->username));
        $this->email = h(st($this->email));
        $this->password = h(st($this->password));
        $this->height = h(st($this->height));
        $this->weight = h(st($this->weight));
        $this->gender = h(st($this->gender));
        $this->profile_pic = h(st($this->profile_pic));
        $this->user_closed = h(st($this->user_closed));
        $this->created_at = h(st($this->created_at));
        $this->updated_at = h(st($this->updated_at));

        // Bind data
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':height', $this->height);
        $stmt->bindParam(':weight', $this->weight);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':profile_pic', $this->profile_pic);
        $stmt->bindParam(':user_closed', $this->user_closed);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something went wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }
}
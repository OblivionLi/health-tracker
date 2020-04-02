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
            $query = 'SELECT * FROM ' . $this->table . ' 
                    WHERE 
                        email = :email 
                    LIMIT 0,1
                ';

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
            $query = 'SELECT * FROM ' . $this->table . ' 
                    WHERE 
                        username= :username 
                    LIMIT 0,1
                ';

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
                        gender= :gender,
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
            $this->gender = h(st($this->gender));
            $this->user_closed = h(st($this->user_closed));
            $this->created_at = h(st($this->created_at));
            $this->updated_at = h(st($this->updated_at));

            // Bind data
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':gender', $this->gender);
            $stmt->bindParam(':user_closed', $this->user_closed);
            $stmt->bindParam(':created_at', $this->created_at);
            $stmt->bindParam(':updated_at', $this->updated_at);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something went wrong
            var_dump('Error: %s.\n', $stmt->error);

            return false;
        }

        // get all user data based on email and if user account closed
        public function update($username)
        {
            // Create query
            $query = 'UPDATE ' . $this->table . ' 
                            SET 
                                username= :username,
                                email= :email,
                                password= :password,
                                gender= :gender,
                                updated_at= :updated_at
                            WHERE 
                                username= :username
                        ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':gender', $this->gender);
            $stmt->bindParam(':updated_at', $this->updated_at);

            // Execute query
            $stmt->execute();
        }

        // Get user by username
        public function read_user_by_username($username)
        {
            // Create query
            $query = 'SELECT * FROM ' . $this->table . '
                    WHERE
                        username= :username
                    LIMIT 0,1
                ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt->bindParam(':username', $username);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // get all user data based on email and password
        public function read_user($email)
        {
            // Create query
            $query = 'SELECT * FROM ' . $this->table . ' 
                    WHERE 
                        email= :email
                    LIMIT 0,1
                ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt->bindParam(':email', $email);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // get all user data based on email and if user account closed
        public function reopen_user($uc, $id)
        {
            // Create query
            $query = 'UPDATE ' . $this->table . ' 
                    SET 
                        user_closed = :user_closed 
                    WHERE 
                        id= :id
                ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt->bindParam(':user_closed', $uc);
            $stmt->bindParam(':id', $id);

            // Execute query
            $stmt->execute();
        }

        // query to create entry with email and token
        public function create_password_reset($email, $token)
        {
            // Create query
            $query = 'INSERT INTO password_resets ' . '
                    SET
                        email= :email,
                        token= :token
                ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->email = h(st($email));
            $this->token = h(st($token));

            // Bind data
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something went wrong
            printf('Error: %s.\n', $stmt->error);

            return false;
        }

        // query to get email from password_reset table basked on token
        public function read_password_reset($token)
        {
            // Create query
            $query = 'SELECT email FROM password_resets
                    WHERE  token = :token
                    LIMIT 0,1';

            // Prepare statemenet
            $stmt = $this->conn->prepare($query);

            // Bind token
            $stmt->bindParam(':token', $token);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // query to delete password_reset entry after successful password reset
        public function delete_password_reset($email)
        {
            // Create query
            $query = 'DELETE FROM password_resets WHERE email = :email';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->email = h(st($email));

            // Bind data
            $stmt->bindParam(':email', $email);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something is wrong
            printf('Error: %s.\n', $stmt->error);

            return false;
        }

        // update user based on the email taken from the password_reset request
        public function update_user($email, $password, $updated_at)
        {
            // Create query
            $query = 'UPDATE ' . $this->table . ' 
                    SET 
                        password = :password,
                        updated_at = :updated_at
                    WHERE 
                        email= :email
                ';

            // Prepare statemenet
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':updated_at', $updated_at);

            // Execute query
            $stmt->execute();

            return $stmt;
        }
    }

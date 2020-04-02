 <?php

   class Health
   {
      // DB prop
      private $conn;
      private $table = 'users_health';

      // Class Properties
      private $id;
      private $user_id;
      private $weight;
      private $height;
      private $created_at;

      // DB __constructor
      public function __construct($db)
      {
         $this->conn = $db;
      }

      /**
       * @return mixed
       */
      public function getId()
      {
         return $this->id;
      }

      /**
       * @param mixed $id
       */
      public function setId($id)
      {
         $this->id = $id;
      }

      /**
       * @return mixed
       */
      public function getUserId()
      {
         return $this->user_id;
      }

      /**
       * @param mixed $user_id
       */
      public function setUserId($user_id)
      {
         $this->user_id = $user_id;
      }

      /**
       * @return mixed
       */
      public function getWeight()
      {
         return $this->weight;
      }

      /**
       * @param mixed $weight
       */
      public function setWeight($weight)
      {
         $this->weight = $weight;
      }

      /**
       * @return mixed
       */
      public function getHeight()
      {
         return $this->height;
      }

      /**
       * @param mixed $height
       */
      public function setHeight($height)
      {
         $this->height = $height;
      }

      /**
       * @return mixed
       */
      public function getCreatedAt()
      {
         return $this->created_at;
      }

      /**
       * @param mixed $created_at
       */
      public function setCreatedAt($created_at)
      {
         $this->created_at = $created_at;
      }

      // Get user data 
      public function read()
      {
         // Create query
         $query = 'SELECT * FROM ' . $this->table;

         // Prepare statement
         $stmt = $this->conn->prepare($query);

         // Execute query
         $stmt->execute();

         return $stmt;
      }

      // Create query for Health class
      public function create()
      {
         // Create query
         $query = 'INSERT INTO ' . $this->table . '
                  SET
                      user_id= :user_id,
                      height= :height,
                      weight= :weight,
                      created_at= :created_at
              ';

         // Prepare statement
         $stmt = $this->conn->prepare($query);

         // Clean data
         $this->setUser = h(st($this->user_id));
         $this->height = h(st($this->height));
         $this->weight = h(st($this->weight));
         $this->created_at = h(st($this->created_at));

         // Bind data
         $stmt->bindParam(':user_id', $this->user_id);
         $stmt->bindParam(':height', $this->height);
         $stmt->bindParam(':weight', $this->weight);
         $stmt->bindParam(':created_at', $this->created_at);

         // Execute query
         if ($stmt->execute()) {
            return true;
         }

         // Print error if something went wrong
         var_dump('Error: %s.\n', $stmt->error);

         return false;
      }

      // Update query for Health class
      public function update($user_id)
      {
         // Create query
         $query = 'UPDATE ' . $this->table . ' 
                  SET 
                     weight= :weight,
                     height= :height,
                     created_at= :created_at
                  WHERE 
                     user_id= :user_id
            ';

         // Prepare statement
         $stmt = $this->conn->prepare($query);

         // Bind data
         $stmt->bindParam(':user_id', $user_id);
         $stmt->bindParam(':weight', $this->weight);
         $stmt->bindParam(':height', $this->height);
         $stmt->bindParam(':created_at', $this->created_at);

         // Execute query
         $stmt->execute();
      }

      // Check if user has already set weight/height values
      public function check_user_info($user_id)
      {
         // Create query
         $query = 'SELECT * FROM ' . $this->table . ' 
                  WHERE 
                      user_id= :user_id 
                  LIMIT 0,1
              ';

         // Prepare statement
         $stmt = $this->conn->prepare($query);

         // Bind user_id
         $stmt->bindParam(':user_id', $user_id);

         // Execute query
         $stmt->execute();

         return $stmt;
      }

      // BMI calculator based on height and weight
      public function calculate_bmi($weight, $height) {
         // splits height var value
         $splitted = str_split($height);

         // check if it has been splitted in 3 values
         if (count($splitted) == 3) {
            // put all 3 values inside height var in a format of 1.11
            $height = "{$splitted[0]}.{$splitted[1]}{$splitted[2]}";
            // return the formula of bmi calculator
            return $weight / ($height * $height);
         }
      }
   }

   ?>
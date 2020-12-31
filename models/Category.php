<?php
  class Category {
    // DB Stuff
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $name;
    public $created_at;

    // Construcor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get all categories
    public function read() {
      // Create query 
      $query = 'SELECT
        id,
        name
      FROM
        ' . $this->table . '
      ORDER BY 
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute statement
      $stmt->execute();

      return $stmt;
    }

    // Get single category
    public function read_single() {
      // Query
      $query = 'SELECT 
        id,
        name 
      FROM 
        ' . $this->table . '
      WHERE 
        id = ?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      // Bind param
      $stmt->bindParam(1, $this->id);

      // Execute statement
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id = $row['id'];
      $this->name = $row['name'];
    }

    // Create new category
    public function create() {
      $query = 'INSERT INTO ' . $this->table . '
      SET 
        name = :name';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->name = htmlspecialchars(strip_tags($this->name));

      // Bind params
      $stmt->bindParam(':name', $this->name);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s. \n" . $stmt->error());

      return false;
    }

    // Update category
    public function update() {
      $query = 'UPDATE ' . $this->table .'
      SET
        name = :name
      WHERE 
        id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->name = htmlspecialchars(strip_tags($this->name));

      // Bind params
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':name', $this->name);

      // Execute statement
      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s. \n" . $stmt->error);

      return false;
    }

  }
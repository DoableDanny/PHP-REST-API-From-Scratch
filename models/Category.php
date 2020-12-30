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

  }
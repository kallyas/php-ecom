<?php

class Category
{
    // Database connection and table name
    private $conn;
    private $table_name = "categories";

    // Object properties
    public $id;
    public $name;
    public $description;
    public $created_at;

    // Constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Read categories
    function read()
    {
        // Select all query
        $query = "SELECT
                    id, name, description, created_at
                FROM
                    " . $this->table_name . "
                ORDER BY
                    created_at DESC";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create category
    function create()
    {
        // Query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, description=:description, created_at=:created_at";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created_at", $this->created_at);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Used when filling up the update product form
    function readOne()
    {
        // Query to read single record
        $query = "SELECT
                    id, name, description, created_at
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->created_at = $row['created_at'];
    }


    // Update the category
    function update()
    {
        // Update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    description = :description,
                    created_at = :created_at
                WHERE
                    id = :id";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':id', $this->id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete the category
    function delete()
    {
        // Delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Search categories
    function search($keywords)
    {
        // Select all query
        $query = "SELECT
                    id, name, description, created_at
                FROM
                    " . $this->table_name . "
                WHERE
                    name LIKE ? OR description LIKE ? OR created_at LIKE ?
                ORDER BY
                    created_at DESC";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // Bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Read categories with pagination
    public function readPaging($from_record_num, $records_per_page)
    {
        // Select query
        $query = "SELECT
                    id, name, description, created_at
                FROM
                    " . $this->table_name . "
                ORDER BY
                    created_at DESC
                LIMIT
                    ?, ?";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // Execute query
        $stmt->execute();

        // Return values from database
        return $stmt;
    }

    // Used for paging categories
    public function count()
    {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
}

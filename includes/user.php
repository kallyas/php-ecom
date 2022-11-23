<<<<<<< HEAD
<?php

class User {
    // Database connection and table name
    private $conn;
    private $table_name = "users";

    // Object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $access_level;
    public $access_level_name;
    public $created;

    // Constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read users
    function read() {
        // Select all query
        $query = "SELECT
                    u.id, u.name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                ORDER BY
                    u.created DESC";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create user
    function create() {
        // Query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, access_level=:access_level, password=:password, created=:created";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->access_level = htmlspecialchars(strip_tags($this->access_level));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":access_level", $this->access_level);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Used when filling up the update product form
    function readOne() {
        // Query to read single record
        $query = "SELECT
                    u.id, u.name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                WHERE
                    u.id = ?
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
        $this->email = $row['email'];
        $this->access_level = $row['access_level'];
        $this->access_level_name = $row['access_level_name'];
    }

    // Update user
    function update() {
        // Query to update record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, access_level=:access_level
                WHERE
                    id = :id";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->access_level = htmlspecialchars(strip_tags($this->access_level));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':access_level', $this->access_level);
        $stmt->bindParam(':id', $this->id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete user
    function delete() {
        // Query to delete record
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

    // Search users
    function search($keywords) {
        // Query to search records
        $query = "SELECT
                    u.id, u.name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                WHERE
                    u.name LIKE ? OR u.email LIKE ? OR a.name LIKE ?
                ORDER BY
                    u.created DESC";

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

    // Read users with pagination
    public function readPaging($from_record_num, $records_per_page) {
        // Query to read records with limit clause
        $query = "SELECT
                    u.id, u.name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                ORDER BY u.created DESC
                LIMIT ?, ?";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // Execute query
        $stmt->execute();

        // Return values from database
        return $stmt;
    }

    // Used for paging users
    public function count() {
        // Query to count all records
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    // Used to read user name by its ID
    function readName() {
        // Query to read single record
        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";

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
    }

    // Used to read user email by its ID
    function readEmail() {
        // Query to read single record
        $query = "SELECT email FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->email = $row['email'];
    }

    // Used to read user access level by its ID
    function readAccessLevel() {
        // Query to read single record
        $query = "SELECT access_level FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->access_level = $row['access_level'];
    }

    // Used to read user access level name by its ID
    function readAccessLevelName() {
        // Query to read single record
        $query = "SELECT a.name as access_level_name FROM " . $this->table_name . " u LEFT JOIN access_levels a ON u.access_level = a.id WHERE u.id = ? limit 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->access_level_name = $row['access_level_name'];
    }

    // login check
    function login() {
        // Query to read single record
        $query = "SELECT id, name, password, access_level, status FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind given email value
        $stmt->bindParam(1, $this->email);

        // Execute the query
        $stmt->execute();

        // Get number of rows
        $num = $stmt->rowCount();

        // If email exists, assign values to object properties for easy access and use for php sessions
        if ($num > 0) {
            // Get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Assign values to object properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->access_level = $row['access_level'];
            $this->status = $row['status'];

            // Check if password is correct
            $password_is_correct = password_verify($this->password, $row['password']);

            // Return true if email exists in the database and if password is correct
            return $password_is_correct;
        }

        // Return false if email does not exist in the database
        return false;
    }

=======
<?php

class User {
    // Database connection and table name
    private $conn;
    private $table_name = "users";

    // Object properties
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $access_level;
    public $access_level_name;
    public $created_at;

    // Constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read users
    function read() {
        // Select all query
        $query = "SELECT
                    u.id, u.first_name, u.last_name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                ORDER BY
                    u.created DESC";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create user
    function create() {
        // Query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    first_name=:first_name, last_name=:last_name, email=:email, access_level=:access_level, password=:password, created_at=:created_at";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->access_level = htmlspecialchars(strip_tags($this->access_level));
        $this->password = htmlspecialchars(strip_tags(password_hash($this->password, PASSWORD_BCRYPT)));
        $this->created_at = new DateTime();

        // Bind values
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":access_level", $this->access_level);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created_at", $this->created_at->format('Y-m-d H:i:s'));

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Used when filling up the update product form
    function readOne() {
        // Query to read single record
        $query = "SELECT
                    u.id, u.first_name, u.last_name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                WHERE
                    u.id = ?
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
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->email = $row['email'];
        $this->access_level = $row['access_level'];
        $this->access_level_name = $row['access_level_name'];
    }

    // Update user
    function update() {
        // Query to update record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    first_name=:first_name, last_name=:last_name, email=:email, access_level=:access_level
                WHERE
                    id = :id";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->access_level = htmlspecialchars(strip_tags($this->access_level));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind new values
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':access_level', $this->access_level);
        $stmt->bindParam(':id', $this->id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete user
    function delete() {
        // Query to delete record
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

    // Search users
    function search($keywords) {
        // Query to search records
        $query = "SELECT
                    u.id, u.first_name, u.last_name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                WHERE
                    u.first_name, u.last_name LIKE ? OR u.email LIKE ? OR a.name LIKE ?
                ORDER BY
                    u.created DESC";

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

    // Read users with pagination
    public function readPaging($from_record_num, $records_per_page) {
        // Query to read records with limit clause
        $query = "SELECT
                    u.id, u.first_name, u.last_name, u.email, u.access_level, u.created, a.name as access_level_name
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        access_levels a
                            ON u.access_level = a.id
                ORDER BY u.created DESC
                LIMIT ?, ?";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // Execute query
        $stmt->execute();

        // Return values from database
        return $stmt;
    }

    // Used for paging users
    public function count() {
        // Query to count all records
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    // Used to read user name by its ID
    function readName() {
        // Query to read single record
        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
    }

    // Used to read user email by its ID
    function readEmail() {
        // Query to read single record
        $query = "SELECT email FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->email = $row['email'];
    }

    // Used to read user access level by its ID
    function readAccessLevel() {
        // Query to read single record
        $query = "SELECT access_level FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->access_level = $row['access_level'];
    }

    // Used to read user access level name by its ID
    function readAccessLevelName() {
        // Query to read single record
        $query = "SELECT a.name as access_level_name FROM " . $this->table_name . " u LEFT JOIN access_levels a ON u.access_level = a.id WHERE u.id = ? limit 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties
        $this->access_level_name = $row['access_level_name'];
    }

    // login check
    function login() {
        // Query to read single record
        $query = "SELECT id, first_name, last_name, password, access_level FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind given email value
        $stmt->bindParam(1, $this->email);

        // Execute the query
        $stmt->execute();

        // Get number of rows
        $num = $stmt->rowCount();

        // If email exists, assign values to object properties for easy access and use for php sessions
        if ($num > 0) {
            // Get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Assign values to object properties
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->access_level = $row['access_level'];

            // Check if password is correct
            $password_is_correct = password_verify($this->password, $row['password']);

            // Return true if email exists in the database and if password is correct
            return $password_is_correct;
        }

        // Return false if email does not exist in the database
        return false;
    }

>>>>>>> 924f25a64720d00f24ef3bdac7c5a3eacccfb81d
}
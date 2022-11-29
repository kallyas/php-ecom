<!-- file that handles the team  -->

<?php 

require_once 'helpers.php';

    class Team {
        // Database connection and table name
        private $conn;
        private $table_name = "team";

        // Object properties
        public $id;
        public $name;
        public $position;
        public $description;
        public $image;

        // Constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        // Read team
        function read() {
            // Select all query
            $query = "SELECT
                        id, name, position, description, image
                    FROM
                        " . $this->table_name . "
                    ORDER BY
                        id DESC";

            // Prepare query statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Create team
        function create() {
            // Query to insert record
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        name=:name, position=:position, description=:description, image=:image";

            // Prepare query
            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->position = htmlspecialchars(strip_tags($this->position));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->image = htmlspecialchars(strip_tags($this->image));

            // Bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":position", $this->position);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":image", $this->image);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            return false;
        }

        // Used to update the team member record
        function update() {
            // Update query
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        name = :name,
                        position = :position,
                        description = :description,
                        image = :image
                    WHERE
                        id = :id";

            // Prepare query statement
            $stmt = $this->conn->prepare($query);

            // Sanitize
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->position = htmlspecialchars(strip_tags($this->position));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->image = htmlspecialchars(strip_tags($this->image));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind new values
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':position', $this->position);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':id', $this->id);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            }

            return false;
        }

        //  delete the team member
        function delete() {
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

        // Search team members
        function search($keywords) {
            // Select all query
            $query = "SELECT
                        id, name, position, description, image
                    FROM
                        " . $this->table_name . "
                    WHERE
                        name LIKE ? OR position LIKE ? OR description LIKE ? OR image LIKE ?
                    ORDER BY
                        id DESC";

            // Prepare query statement
            $stmt = $this->conn->prepare($query);

            // Sanitize
            $keywords = htmlspecialchars(strip_tags($keywords));
            $keywords = "%{$keywords}%";

            // Bind
            $stmt->bindParam(1, $keywords);
            $stmt->bindParam(2, $keywords);
            $stmt->bindParam(3, $keywords);
            $stmt->bindParam(4, $keywords);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

    }













?>
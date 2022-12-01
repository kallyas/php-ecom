<?php

class Contact {
    // database connection and table name
    private $conn;
    private $table_name = "contact";

    // object properties
    public $id;
    public $name;
    public $email;
    public $message;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // create contact
    function create() {
        //write query
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, message=:message, created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->created_at = new DateTime();

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":created_at", $this->created_at->format('Y-m-d H:i:s'));

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // read all contacts
    function readAll($from_record_num, $records_per_page) {
        $query = "SELECT id, name, email, message, created_at FROM " . $this->table_name . " ORDER BY created_at DESC LIMIT ?, ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    // used for paging contacts
    public function countAll() {
        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    // used to read contact by its ID
    function readOne() {
        $query = "SELECT name, email, message, created_at FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->message = $row['message'];
        $this->created_at = $row['created_at'];
    }

    // delete the contact
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
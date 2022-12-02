<?php
// cart class that will handle cart operations upon ajax requests via javascript


class Cart {
    // database connection and table name
    private $conn;
    private $table_name = "carts";

    // object properties
    public $id;
    public $user_id;
    public $product_id;
    public $quantity;
    public $created_at;

    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read products in the cart
    function read() {
        // select all query
        $query = "SELECT
                    c.id, c.user_id, c.product_id, c.quantity, c.created_at, p.name, p.price, p.image, p.description
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        products p
                            ON c.product_id = p.id
                WHERE
                    c.user_id = ?
                ORDER BY
                    c.created_at DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind user id variable
        $stmt->bindParam(1, $this->user_id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    // add product to cart
    function add() {
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    user_id=:user_id, product_id=:product_id, quantity=:quantity, created_at=:created_at";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->created_at = new DateTime();

        // bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":created_at", $this->created_at->format('Y-m-d H:i:s'));

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // update product quantity in the cart
    function update() {
        // query to update record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    quantity=:quantity
                WHERE
                    id=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind values
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":id", $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete product from the cart
    function delete() {
        // query to delete record
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete all products from the cart
    function deleteAll() {
        // query to delete record
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->user_id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // search products in the cart
    function search($keywords) {
        // select all query
        $query = "SELECT
                    c.id, c.user_id, c.product_id, c.quantity, c.created_at, p.name, p.price
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        products p
                            ON c.product_id = p.id
                WHERE
                    c.user_id = ? AND p.name LIKE ? OR p.description LIKE ?
                ORDER BY
                    c.created_at DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind user id variable
        $stmt->bindParam(1, $this->user_id);

        // bind keywords variable
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function count() {
        // query to count all records
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . " WHERE user_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind user id variable
        $stmt->bindParam(1, $this->user_id);

        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

}
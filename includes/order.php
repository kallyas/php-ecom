<?php

class Order
{

    private $conn;
    private $table_name = 'orders';

    public $id;
    public $user_id;
    public $name;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $country;
    public $phone;
    public $email;
    public $payment;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' SET user_id = :user_id, name = :name, address = :address, city = :city, state = :state, zip = :zip, country = :country, phone = :phone, email = :email, payment = :payment, created_at = :created_at';

        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->zip = htmlspecialchars(strip_tags($this->zip));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->payment = htmlspecialchars(strip_tags($this->payment));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':zip', $this->zip);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':payment', $this->payment);
        $stmt->bindParam(':created_at', $this->created_at);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE user_id = :user_id';

        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(':user_id', $this->user_id);

        $stmt->execute();

        return $stmt;
    }

    public function readOne()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        return $stmt;
    }

    public function readAll()
    {
        $query = 'SELECT * FROM ' . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table_name . ' SET name = :name, address = :address, city = :city, state = :state, zip = :zip, country = :country, phone = :phone, email = :email, payment = :payment WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->zip = htmlspecialchars(strip_tags($this->zip));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->payment = htmlspecialchars(strip_tags($this->payment));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':zip', $this->zip);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':payment', $this->payment);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function search($keywords)
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE name LIKE :keywords OR address LIKE :keywords OR city LIKE :keywords OR state LIKE :keywords OR zip LIKE :keywords OR country LIKE :keywords OR phone LIKE :keywords OR email LIKE :keywords OR payment LIKE :keywords';

        $stmt = $this->conn->prepare($query);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(':keywords', $keywords);

        $stmt->execute();

        return $stmt;
    }

    public function readPaging($from_record_num, $records_per_page)
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' ORDER BY id DESC LIMIT :from_record_num, :records_per_page';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':from_record_num', $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(':records_per_page', $records_per_page, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;
    }

    public function count()
    {
        $query = 'SELECT COUNT(*) as total_rows FROM ' . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
    
}

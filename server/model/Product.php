<?php
class Product
{
    private $conn;

    public function __construct()
    {
        $this->conn = $conn;
    }
    
    public function getProductById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

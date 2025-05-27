<?php
class Product
{
    private PDO $conn;

    public function __construct(PDO $conn)
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

    public function getProductsByFilters($filterQuery)
    {
        $stmt = $this->conn->prepare(
            "SELECT 
            p.*, 
            c.name AS category_name, 
            c.group AS category_group 
            FROM products p 
            JOIN categories c ON p.category_id = c.id" 
            . $filterQuery
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php

class Cart
{
    private $conn;
    private $userId;

    public function __construct($conn, $userId = null)
    {

        $this->conn = $conn;
        $this->userId = $userId;
    }

    public function getUserItems(){

        if (!$this->userId) return [];

        $stmt = $this->conn->prepare("SELECT id FROM shopping_cart WHERE user_id = ?");
        $stmt->execute([$this->userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cart) return [];

        $cartId = $cart['id'];


        $stmt = $this->conn->prepare("
            SELECT 
                ci.id AS cart_item_id, 
                ci.product_id, 
                ci.quantity,
                description,
                p.image_url,
                p.name AS product_name,
                p.price
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.cart_id = ?
        ");

        $stmt->execute([$cartId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clearCartItems($userId){
    
        $stmt = $this->conn->prepare("SELECT id FROM shopping_cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cart) {
            return false; 
        }

        $cartId = $cart['id'];

        
        $stmt = $this->conn->prepare("DELETE FROM cart_items WHERE cart_id = ?");
        return $stmt->execute([$cartId]);
    }

    public function getOrCreateCart($userId){
        $stmt = $this->conn->prepare("SELECT id FROM shopping_cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cart) {
            return $cart['id']; 
        }

        $stmt = $this->conn->prepare("INSERT INTO shopping_cart (user_id, created_at) VALUES (?, NOW())");
        $stmt->execute([$userId]);

        return $this->conn->lastInsertId(); 
    }


}

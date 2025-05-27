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

    public function getItems()
    {

        if (!$this->userId) return [];

        $stmt = $this->conn->prepare("SELECT id FROM shopping_cart WHERE user_id = ?");
        $stmt->execute([$this->userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cart) return [];

        $cartId = $cart['id'];


        $stmt = $this->conn->prepare("
            SELECT ci.id AS cart_item_id, ci.product_id, ci.quantity
            FROM cart_items ci
            WHERE ci.cart_id = ?
        ");
        $stmt->execute([$cartId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserItems()
    {

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
}

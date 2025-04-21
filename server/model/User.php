<?php
class User
{
    private $conn;

    public function __construct()
    {
        require '../config/db.php';
        $this->conn = $conn;
    }

    public function login($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM 'users' WHERE 'email' = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($name, $email, $password)
    {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $hashed]);
    }
}

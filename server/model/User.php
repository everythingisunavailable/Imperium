<?php
class User
{
    private $conn;

    public function __construct()
    {
        require '../../config/db.php';
        $this->conn = $conn;
    }

    public function login($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($name, $surname, $email, $password)
    {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $surname, $email, $hashed]);
    }
    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function generateRecoveryToken($email, $code) {
        $expiry = date("Y-m-d H-i-s", time() + 60 * 3); //current time plus 3 minutes
        $stmt = $this->conn->prepare("UPDATE users SET resetCode = ?, resetCodeExpiry = ?, newPasswordExpiry = ? WHERE email = ?");
        return $stmt->execute([$code, $expiry, null, $email]);
    }
    public function approveResetCode($email) {
        $expiry = date("Y-m-d H-i-s", time() + 60 * 3); //current time plus 3 minutes
        $stmt = $this->conn->prepare("UPDATE users SET resetCode = ?, resetCodeExpiry = ?, newPasswordExpiry = ? WHERE email = ?");
        return $stmt->execute([null, null, $expiry, $email]);
    }
    public function updatePassword($email, $password) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("UPDATE users SET password = ?, newPasswordExpiry = ? WHERE email = ?");
        return $stmt->execute([$hashed, null, $email]);
    }
}

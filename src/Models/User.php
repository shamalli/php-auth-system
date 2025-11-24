<?php
namespace AuthSystem\Models;

use AuthSystem\Config\Config;

class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function create(string $name, string $email, string $phone, string $password): int {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
        
        return $this->db->insert($sql, [$name, $email, $phone, $hashed_password], "ssss");
    }
    
    public function findByEmailOrPhone(string $login): ?array {
        $sql = "SELECT id, name, email, phone, password FROM users WHERE email = ? OR phone = ?";
        return $this->db->fetchOne($sql, [$login, $login], "ss");
    }
    
    public function findById(int $id): ?array {
        $sql = "SELECT id, name, email, phone FROM users WHERE id = ?";
        return $this->db->fetchOne($sql, [$id], "i");
    }
    
    public function checkUniqueFields(string $email, string $phone, ?int $exclude_id = null): array {
        $sql = "SELECT id, email, phone FROM users WHERE (email = ? OR phone = ?)";
        $params = [$email, $phone];
        $types = "ss";
        
        if ($exclude_id) {
            $sql .= " AND id != ?";
            $params[] = $exclude_id;
            $types .= "i";
        }
        
        $users = $this->db->fetchAll($sql, $params, $types);
        
        $conflicts = [];
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $conflicts[] = 'email';
            }
            if ($user['phone'] === $phone) {
                $conflicts[] = 'phone';
            }
        }
        
        return $conflicts;
    }
    
    public function update(int $id, string $name, string $email, string $phone, ?string $password = null): int {
        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = ?, email = ?, phone = ?, password = ? WHERE id = ?";
            return $this->db->execute($sql, [$name, $email, $phone, $hashed_password, $id], "ssssi");
        } else {
            $sql = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
            return $this->db->execute($sql, [$name, $email, $phone, $id], "sssi");
        }
    }
    
    public function verifyPassword(string $password, string $hashed_password): bool {
        return password_verify($password, $hashed_password);
    }
}
?>
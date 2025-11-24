<?php
namespace AuthSystem\Models;

use mysqli;
use Exception;

class Database {
    private $connection;
    private static $instance = null;
    
    private function __construct() {
        $this->connection = new mysqli(
            \AuthSystem\Config\Config::DB_HOST,
            \AuthSystem\Config\Config::DB_USER,
            \AuthSystem\Config\Config::DB_PASS,
            \AuthSystem\Config\Config::DB_NAME
        );
        
        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }
        
        $this->connection->set_charset("utf8");
    }
    
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection(): mysqli {
        return $this->connection;
    }
    
    public function query(string $sql, array $params = [], string $types = ""): \mysqli_stmt {
        $stmt = $this->connection->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $this->connection->error);
        }
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        return $stmt;
    }
    
    public function fetchOne(string $sql, array $params = [], string $types = ""): ?array {
        $stmt = $this->query($sql, $params, $types);
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }
    
    public function fetchAll(string $sql, array $params = [], string $types = ""): array {
        $stmt = $this->query($sql, $params, $types);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function insert(string $sql, array $params = [], string $types = ""): int {
        $stmt = $this->query($sql, $params, $types);
        return $stmt->insert_id;
    }
    
    public function execute(string $sql, array $params = [], string $types = ""): int {
        $stmt = $this->query($sql, $params, $types);
        return $stmt->affected_rows;
    }
}
?>
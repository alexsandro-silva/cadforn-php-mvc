<?php

namespace App\Core\Database;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private static string $host;
    private static string $dbname;
    private static string $user;
    private static string $pass;
    private static int $port;

    private string $table;
    private PDO $connection;

    public function __construct(string $table)
    {
        $this->table = $table;    
        $this->setConnection();
    }

    public static function config(string $host, string $dbname, string $user, string $password, int $port = 3306): void
    {
        self::$host = $host;
        self::$dbname = $dbname;
        self::$user = $user;
        self::$pass = $password;
        self::$port = $port;
    }

    private function setConnection(): void
    {
        try {
            $this->connection = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname.';port='.self::$port, self::$user, self::$pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /**
     * Executes queries on database
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function executeQuery(string $query, array $params = []): PDOStatement
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function insert(array $values): int
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        $query = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $binds) . ')';

        $this->executeQuery($query, array_values($values));

        return $this->connection->lastInsertId();
    }

    public function select(string $where = null, string $order = null, string $limit = null, array $fields = []): PDOStatement
    {
        $fields = !empty($fields) ? implode(', ',$fields) : '*';
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' '. $order . ' ' . $limit;

        return $this->executeQuery($query);
    }

    public function update(string $where, array $values): bool
    {
        $fields = array_map(function($field) {
            return $field . ' = ?';
        }, array_keys($values));

        $query = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $fields) . ' WHERE ' . $where;

        $this->executeQuery($query);
        
        return true;
    }

    public function delete(string $where): bool
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        $this->executeQuery($query);

        return true;
    }

}
<?php

namespace App\model;

use PDO;

class db
{
    private $pdo;
    private $table;

    public function __construct()
    {

        $this->pdo = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s;port=%s;charset=%s',
                DATABASE['host'],
                DATABASE['name'],
                DATABASE['port'],
                DATABASE['charset']
            ),
            DATABASE['username'],
            DATABASE['password']
        );
    }

    public function insert($data)
    {
        $columns      = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        try {

            $sql = "INSERT INTO $this->table ( $columns ) VALUES ($placeholders)";

            $stm = $this->pdo->prepare($sql);

            foreach ($data as $key => $value) {
                $stm->bindValue(":$key", $value);
            }

            $stm->execute();

            return $this->pdo->lastInsertId();
        } catch (\Exception $e) {
            error_log('PDO Exception: ' . $e->getMessage());
            return false;
        } catch (\PDOException $e) {
            error_log('PDO Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function update()
    {

    }

    public function select($columns = '*', $where = '', $params = [], $joins = '')
    {
        $sql = "SELECT $columns FROM $this->table $joins ";

        if (!empty($where)) {
            $sql .= " WHERE $where";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function delete()
    {

    }

    public function setTable($tableName)
    {
        $this->table = $tableName;
    }
}

?>
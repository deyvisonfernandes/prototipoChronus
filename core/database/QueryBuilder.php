<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table, $inicio = null, $rows_count = null)
    {
        $sql = "select * from {$table}";

        if($inicio >= 0 && $rows_count > 0) {
            $sql .= " LIMIT {$inicio}, {$rows_count}";
        }
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectOne($table, $id){
        $sql = sprintf('SELECT * FROM %s WHERE id=:id LIMIT 1', $table);
         try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }


    }

    public function selectWhereLike($table, $column, $value)
{
    $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$column} LIKE ?");
    $statement->execute(["%$value%"]);
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectWhere($table, $conditions) {
    $fields = array_keys($conditions);
    $sql = "SELECT * FROM {$table} WHERE " . implode(' = ? AND ', $fields) . " = ?";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(array_values($conditions));

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

    public function insert($table, $parameters) {
        $sql = sprintf('INSERT INTO %s (%s) VALUES (:%s)',
        $table,
        implode(', ', array_keys($parameters)),
        implode(', :', array_keys($parameters)),
    );

    try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectAllOrderBy($table, $orderBy, $direction = 'DESC', $inicio = null, $rows_count = null)
{
    $sql = "SELECT * FROM {$table} ORDER BY {$orderBy} {$direction}";

    if($inicio >= 0 && $rows_count > 0) {
        $sql .= " LIMIT {$inicio}, {$rows_count}";
    }

    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

    public function update($table, $id, $parametros)
    {
        $sql = sprintf('UPDATE %s SET %s WHERE id = %s',
        $table,
        implode(', ', array_map(function($param) {
            return $param . ' = :' . $param;
        }, array_keys($parametros))),
        $id,
    );
    
    try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            return true;

        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
    public function delete($table, $id){
     $sql = sprintf('DELETE FROM %s WHERE %s',
        $table,
        'id = :id'
    );
    

    try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) FROM {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return intval($stmt->fetch(PDO::FETCH_COLUMN));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

public function verificaLogin($email, $senha)
    {
        $sql = sprintf('SELECT * FROM usuarios WHERE email = :email AND senha = :senha');




        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'senha' => $senha
            ]
            );

            $user = $stmt->fetch(PDO::FETCH_OBJ);

            return $user;

        } catch (Exception $e) {
            die($e->getMessage());
        }
        
}
}
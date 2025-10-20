<?php

namespace App;

use Doctrine\DBAL\DriverManager;

class Model
{
    protected $connection;
    protected $tableName;

    public function __construct()
    {
        $connectionParams = [
            'dbname'    => $_ENV['DB_NAME'],
            'user'      => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'host'      => $_ENV['DB_HOST'],
            'driver'    => $_ENV['DB_DRIVER'],
            'port'      => $_ENV['DB_PORT'],
        ];

        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public function getList() 
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')->from($this->tableName);

        return $queryBuilder->fetchAllAssociative();
    }

    public function getPaginated($page = 1, $perPage = 10) 
    {
        $offset = ($page - 1) * $perPage;
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->setFirstResult($offset)
            ->setMaxResults($perPage);

        return $queryBuilder->fetchAllAssociative();
    }

    public function getTotalCount() 
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('COUNT(*) as total')->from($this->tableName);

        return (int) $queryBuilder->fetchOne()['total'];
    }

    public function findById($id) 
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->where('id = :id')
            ->setParameter('id', $id);

        return $queryBuilder->fetchAssociative();
    }

    public function insert($data)
    {
        $this->connection->insert($this->tableName, $data);

        return $this->connection->lastInsertId();
    }

    public function update($id, $data)
    {
        return $this->connection->update($this->tableName, $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->connection->delete($this->tableName, ['id' => $id]);
    }
}
<?php
namespace App\Models;

use App\Model;

class User extends Model {
    protected $tableName = 'users';

    public function findByEmail($email) {
        $qb = $this->connection->createQueryBuilder();
        $qb->select('*')
            ->from($this->tableName)
            ->where('email = :email')
            ->setParameter('email', $email);
        return $qb->fetchAssociative();
    }
      public function getTotalCount() {
    $qb = $this->connection->createQueryBuilder();
    $qb->select('COUNT(*) as total')
        ->from($this->tableName);
    $result = $qb->fetchAssociative();
    return $result['total'] ?? 0;
}
}
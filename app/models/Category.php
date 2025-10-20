<?php
namespace App\Models;

use App\Model;

class Category extends Model {
    protected $tableName = 'categories';

      public function getTotalCount() {
    $qb = $this->connection->createQueryBuilder();
    $qb->select('COUNT(*) as total')
        ->from($this->tableName);
    $result = $qb->fetchAssociative();
    return $result['total'] ?? 0;
}
}
<?php
namespace App\Models;

use App\Model;

class Product extends Model {
    protected $tableName = 'products';

    // Method tùy chọn: Lấy products theo category
    public function getByCategory($categoryId) {
        $qb = $this->connection->createQueryBuilder();
        $qb->select('*')
            ->from($this->tableName)
            ->where('category_id = :category_id')
            ->setParameter('category_id', $categoryId);
        return $qb->fetchAllAssociative();
    }
      public function getTotalCount() {
    $qb = $this->connection->createQueryBuilder();
    $qb->select('COUNT(*) as total')
        ->from($this->tableName);
    $result = $qb->fetchAssociative();
    return $result['total'] ?? 0;
}
}
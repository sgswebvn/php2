<?php
namespace App\Models;

use App\Model;

class Order extends Model {
    protected $tableName = 'orders';

    // Lấy orders của user
    public function getByUser($userId) {
        $qb = $this->connection->createQueryBuilder();
        $qb->select('*')
            ->from($this->tableName)
            ->where('user_id = :user_id')
            ->setParameter('user_id', $userId);
        return $qb->fetchAllAssociative();
    }

    // Lấy items của order
    public function getItems($orderId) {
        $qb = $this->connection->createQueryBuilder();
        $qb->select('*')
            ->from('order_items')
            ->where('order_id = :order_id')
            ->setParameter('order_id', $orderId);
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
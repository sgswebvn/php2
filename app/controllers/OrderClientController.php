<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Order;

class OrderClientController extends Controller {
    private Order $order;

    public function __construct() {
        $this->order = new Order();
    }

    public function index() {
        if (empty($_SESSION['user'])) {
            redirect('/auth/login');
        }

        $orders = $this->order->getByUser($_SESSION['user']['id']);
        return view('client.orders.list', compact('orders'));
    }

    public function show($id) {
        if (empty($_SESSION['user'])) {
            redirect('/auth/login');
        }

        $order = $this->order->findById($id);
        if (empty($order) || $order['user_id'] != $_SESSION['user']['id']) {
            redirect404();
        }

        $items = $this->order->getItems($id);
        return view('client.orders.detail', compact('order', 'items'));
    }
}
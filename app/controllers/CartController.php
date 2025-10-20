<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller {
    private Product $product;
    private Order $order; 

    public function __construct() {
        $this->product = new Product();
        $this->order = new Order(); 
    }

    public function index() {
        $cart = $_SESSION['cart'] ?? [];
        $total = 0;
        $items = [];

        foreach ($cart as $productId => $quantity) {
            $product = $this->product->findById($productId);
            if ($product) {
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;
                $items[] = ['product' => $product, 'quantity' => $quantity, 'subtotal' => $subtotal];
            }
        }

        return view('client.cart', compact('items', 'total'));
    }

    public function add($id) {
        $product = $this->product->findById($id);
        if (empty($product) || $product['stock'] <= 0) {
            $_SESSION['errors'] = ['Sản phẩm không khả dụng'];
            redirect('/products/' . $id);
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        redirect('/cart');
    }

    public function update() {
        $data = $_POST;
        foreach ($data['quantity'] as $id => $quantity) {
            $product = $this->product->findById($id);
            if ($product && $quantity > $product['stock']) {
                $_SESSION['errors'] = ['Số lượng vượt quá tồn kho cho ' . $product['name']];
                redirect('/cart');
            }
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id] = (int)$quantity;
            }
        }
        redirect('/cart');
    }

    public function remove($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        redirect('/cart');
    }

    public function checkout() {
        if (empty($_SESSION['user'])) {
            redirect('/auth/login');
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            redirect('/cart');
        }

        $total = 0;
        $orderData = [
            'user_id' => $_SESSION['user']['id'],
            'total_amount' => 0,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $orderItems = [];
        foreach ($cart as $productId => $quantity) {
            $product = $this->product->findById($productId);
            if ($product && $product['stock'] >= $quantity) {
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;
                $orderItems[] = [
                    'order_id' => null,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product['price']
                ];
                $this->product->update($productId, ['stock' => $product['stock'] - $quantity]);
            } else {
                $_SESSION['errors'] = ['Tồn kho không đủ cho ' . $product['name']];
                redirect('/cart');
            }
        }

        $orderData['total_amount'] = $total;
        $orderId = $this->order->insert($orderData);

        foreach ($orderItems as &$item) {
            $item['order_id'] = $orderId;
            (new OrderItem())->insert($item);
        }

        unset($_SESSION['cart']);
        $_SESSION['success'] = 'Đặt hàng thành công!';
        redirect('/orders');
    }
}
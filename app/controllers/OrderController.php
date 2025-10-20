<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Rakit\Validation\Validator;

class OrderController extends Controller {
    private Order $order;

    public function __construct() {
        $this->order = new Order();
    }

    public function dashboard() {
        // Lấy stats cho dashboard
        $totalOrders = $this->order->getTotalCount();
        $totalProducts = (new Product())->getTotalCount();
        $totalUsers = (new User())->getTotalCount();
        $totalCategories = (new Category())->getTotalCount();
        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalUsers', 'totalCategories'));
    }

    public function index() {
        $page = $_GET['page'] ?? 1;
        $perPage = 10;
        $orders = $this->order->getPaginated($page, $perPage);
        $total = $this->order->getTotalCount();
        $paginator = [
            'total_pages' => ceil($total / $perPage),
            'current_page' => $page,
            'per_page' => $perPage
        ];
        return view('admin.orders.list', compact('orders', 'paginator'));
    }

    public function view($id) {
        $order = $this->order->findById($id);
        if (empty($order)) {
            redirect404();
        }
        $items = $this->order->getItems($id);
        return view('admin.orders.view', compact('order', 'items'));
    }

    public function edit($id) {
        $order = $this->order->findById($id);
        if (empty($order)) {
            redirect404();
        }
        return view('admin.orders.edit', compact('order'));
    }

    public function update($id) {
        $order = $this->order->findById($id);
        if (empty($order)) {
            redirect404();
        }

        try {
            $data = $_POST;

            $validator = new Validator();
            $errors = $this->validate($validator, $data, [
                'status' => 'required|in:pending,processing,completed,cancelled'
            ]);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect("/admin/orders/{$id}/edit");
            }

            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->order->update($id, $data);

            redirect('/admin/orders');
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            redirect("/admin/orders/{$id}/edit");
        }
    }

    public function delete($id) {
        $order = $this->order->findById($id);
        if (empty($order)) {
            redirect404();
        }
        $this->order->delete($id);
        redirect('/admin/orders');
    }
}
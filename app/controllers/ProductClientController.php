<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Product;
use App\Models\Category;

class ProductClientController extends Controller {
    private Product $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function index() {
        $page = $_GET['page'] ?? 1;
        $perPage = 12;  
        $products = $this->product->getPaginated($page, $perPage);
        $total = $this->product->getTotalCount();
        $paginator = [
            'total_pages' => ceil($total / $perPage),
            'current_page' => $page,
            'per_page' => $perPage
        ];
        $categories = (new Category())->getList();
        return view('client.products.list', compact('products', 'categories', 'paginator'));
    }

    public function show($id) {
        $product = $this->product->findById($id);
        if (empty($product)) {
            redirect404();
        }
        $relatedProducts = $this->product->getByCategory($product['category_id']);  // Related products
        return view('client.products.detail', compact('product', 'relatedProducts'));
    }
}
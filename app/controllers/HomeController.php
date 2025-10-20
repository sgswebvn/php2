<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller {
    public function index() {
        $categories = (new Category())->getList();
        $featuredProducts = (new Product())->getPaginated(1, 5);  // 5 sản phẩm nổi bật for slider
        $productsByCategory = [];
        foreach ($categories as $c) {
            $productsByCategory[$c['id']] = (new Product())->getByCategory($c['id']);
        }
        return view('client.home', compact('categories', 'featuredProducts', 'productsByCategory'));
    }
}
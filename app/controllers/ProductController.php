<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Category;
use App\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller {
    private Product $product;
    private Category $category;

    public function __construct() {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index() {
        $page = $_GET['page'] ?? 1;
        $perPage = 10;
        $products = $this->product->getPaginated($page, $perPage);
        $total = $this->product->getTotalCount();
        $paginator = [
            'total_pages' => ceil($total / $perPage),
            'current_page' => $page,
            'per_page' => $perPage
        ];
        return view('admin.products.list', compact('products', 'paginator'));
    }

    public function create() {
        $categories = $this->category->getList();
        return view('admin.products.create', compact('categories'));
    }

    public function store() {
        try {
            $data = $_POST + $_FILES;

            $validator = new Validator();
            $errors = $this->validate($validator, $data, [
                'name' => 'required|max:255',
                'category_id' => 'required|integer',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'img_thumbnail' => 'nullable|uploaded_file:0,2048K,png,jpeg,jpg',
                'description' => 'nullable'
            ]);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect('/admin/products/create');
            }

            if (is_upload('img_thumbnail')) {
                $data['img_thumbnail'] = $this->uploadFile($data['img_thumbnail'], 'products');
            } else {
                $data['img_thumbnail'] = null;
            }

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->product->insert($data);

            redirect('/admin/products');
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            redirect('/admin/products/create');
        }
    }

    public function edit($id) {
        $product = $this->product->findById($id);
        if (empty($product)) {
            redirect404();
        }
        $categories = $this->category->getList();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update($id) {
        $product = $this->product->findById($id);
        if (empty($product)) {
            redirect404();
        }

        try {
            $data = $_POST + $_FILES;

            $validator = new Validator();
            $errors = $this->validate($validator, $data, [
                'name' => 'required|max:255',
                'category_id' => 'required|integer',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'img_thumbnail' => 'nullable|uploaded_file:0,2048K,png,jpeg,jpg',
                'description' => 'nullable'
            ]);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect("/admin/products/{$id}/edit");
            }

            if (is_upload('img_thumbnail')) {
                if ($product['img_thumbnail'] && file_exists($product['img_thumbnail'])) {
                    unlink($product['img_thumbnail']);
                }
                $data['img_thumbnail'] = $this->uploadFile($data['img_thumbnail'], 'products');
            } else {
                unset($data['img_thumbnail']);
            }

            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->product->update($id, $data);

            redirect('/admin/products');
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            redirect("/admin/products/{$id}/edit");
        }
    }

    public function delete($id) {
        $product = $this->product->findById($id);
        if (empty($product)) {
            redirect404();
        }
        if ($product['img_thumbnail'] && file_exists($product['img_thumbnail'])) {
            unlink($product['img_thumbnail']);
        }
        $this->product->delete($id);
        redirect('/admin/products');
    }
}
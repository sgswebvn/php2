<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Category;
use Rakit\Validation\Validator;

class CategoryController extends Controller {
    private Category $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function index() {
        $page = $_GET['page'] ?? 1;
        $perPage = 10;
        $categories = $this->category->getPaginated($page, $perPage);
        $total = $this->category->getTotalCount();
        $paginator = [
            'total_pages' => ceil($total / $perPage),
            'current_page' => $page,
            'per_page' => $perPage
        ];
        return view('admin.categories.list', compact('categories', 'paginator'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store() {
        try {
            $data = $_POST;

            $validator = new Validator();
            $errors = $this->validate($validator, $data, [
                'name' => 'required|max:255',
                'description' => 'nullable'
            ]);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect('/admin/categories/create');
            }

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->category->insert($data);

            redirect('/admin/categories');
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            redirect('/admin/categories/create');
        }
    }

    public function edit($id) {
        $category = $this->category->findById($id);
        if (empty($category)) {
            redirect404();
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update($id) {
        $category = $this->category->findById($id);
        if (empty($category)) {
            redirect404();
        }

        try {
            $data = $_POST;

            $validator = new Validator();
            $errors = $this->validate($validator, $data, [
                'name' => 'required|max:255',
                'description' => 'nullable'
            ]);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect("/admin/categories/{$id}/edit");
            }

            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->category->update($id, $data);

            redirect('/admin/categories');
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            redirect("/admin/categories/{$id}/edit");
        }
    }

    public function delete($id) {
        $category = $this->category->findById($id);
        if (empty($category)) {
            redirect404();
        }
        $this->category->delete($id);
        redirect('/admin/categories');
    }
}
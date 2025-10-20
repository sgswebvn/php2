<?php
namespace App\Controllers;

use App\Controller;
use App\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller {
    private User $user;

    public function __construct() {
        $this->user = new User();
    }

    public function index() {
        $page = $_GET['page'] ?? 1;
        $perPage = 10;
        $users = $this->user->getPaginated($page, $perPage);
        $total = $this->user->getTotalCount();
        $paginator = [
            'total_pages' => ceil($total / $perPage),
            'current_page' => $page,
            'per_page' => $perPage
        ];
        return view('admin.users.list', compact('users', 'paginator'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store() {
        try {
            $data = $_POST;

            $validator = new Validator();
            $errors = $this->validate($validator, $data, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'type' => 'required|in:admin,user'
            ]);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect('/admin/users/create');
            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->user->insert($data);

            redirect('/admin/users');
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            redirect('/admin/users/create');
        }
    }

    public function edit($id) {
        $user = $this->user->findById($id);
        if (empty($user)) {
            redirect404();
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update($id) {
        $user = $this->user->findById($id);
        if (empty($user)) {
            redirect404();
        }

        try {
            $data = $_POST;

            $validator = new Validator();
            $errors = $this->validate($validator, $data, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'nullable|min:6',
                'type' => 'required|in:admin,user'
            ]);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                redirect("/admin/users/{$id}/edit");
            }

            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                unset($data['password']);
            }

            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->user->update($id, $data);

            redirect('/admin/users');
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            redirect("/admin/users/{$id}/edit");
        }
    }

    public function delete($id) {
        $user = $this->user->findById($id);
        if (empty($user)) {
            redirect404();
        }
        $this->user->delete($id);
        redirect('/admin/users');
    }
}
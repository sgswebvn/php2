<?php
namespace App\Controllers;

use App\Controller;
use App\Models\User;
use Rakit\Validation\Validator;

class AuthController extends Controller {
    private User $user;

    public function __construct() {
        $this->user = new User();
    }

    public function loginForm() {
        return view('auth.login');
    }

    public function login() {
        $data = $_POST;
        $validator = new Validator();
        $errors = $this->validate($validator, $data, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('/auth/login');
        }

        $user = $this->user->findByEmail($data['email']);
        if ($user && password_verify($data['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            $redirectTo = ($user['type'] == 'admin') ? '/admin' : '/';
            redirect($redirectTo);
        } else {
            $_SESSION['errors'] = ['Invalid credentials'];
            redirect('/auth/login');
        }
    }

    public function registerForm() {
        return view('auth.register');
    }

    public function register() {
        $data = $_POST;
        $validator = new Validator();
        $errors = $this->validate($validator, $data, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('/auth/register');
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['type'] = 'user';
        $this->user->insert($data);

        redirect('/auth/login');
    }

    public function logout() {
        unset($_SESSION['user']);
        redirect('/auth/login');
    }
}
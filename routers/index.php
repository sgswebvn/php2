<?php

use Bramus\Router\Router;
use App\Controllers\{AuthController, CategoryController, ProductController, UserController, OrderController, HomeController, ProductClientController, CartController, OrderClientController};

$router = new Router();

middleware_auth();  

// Auth routes
$router->get('/auth/login', AuthController::class . '@loginForm');
$router->post('/auth/login', AuthController::class . '@login');
$router->get('/auth/register', AuthController::class . '@registerForm');
$router->post('/auth/register', AuthController::class . '@register');
$router->get('/auth/logout', AuthController::class . '@logout');

// Admin routes
$router->get('/admin', OrderController::class . '@dashboard'); 

// Admin Categories
$router->get('/admin/categories', CategoryController::class . '@index');
$router->get('/admin/categories/create', CategoryController::class . '@create');
$router->post('/admin/categories/store', CategoryController::class . '@store');
$router->get('/admin/categories/{id}/edit', CategoryController::class . '@edit');
$router->post('/admin/categories/{id}/update', CategoryController::class . '@update');
$router->get('/admin/categories/{id}/delete', CategoryController::class . '@delete');

// Admin Products
$router->get('/admin/products', ProductController::class . '@index');
$router->get('/admin/products/create', ProductController::class . '@create');
$router->post('/admin/products/store', ProductController::class . '@store');
$router->get('/admin/products/{id}/edit', ProductController::class . '@edit');
$router->post('/admin/products/{id}/update', ProductController::class . '@update');
$router->get('/admin/products/{id}/delete', ProductController::class . '@delete');

// Admin Users
$router->get('/admin/users', UserController::class . '@index');
$router->get('/admin/users/create', UserController::class . '@create');
$router->post('/admin/users/store', UserController::class . '@store');
$router->get('/admin/users/{id}/edit', UserController::class . '@edit');
$router->post('/admin/users/{id}/update', UserController::class . '@update');
$router->get('/admin/users/{id}/delete', UserController::class . '@delete');

// Admin Orders
$router->get('/admin/orders', OrderController::class . '@index');
$router->get('/admin/orders/{id}/view', OrderController::class . '@view');
$router->get('/admin/orders/{id}/edit', OrderController::class . '@edit');
$router->post('/admin/orders/{id}/update', OrderController::class . '@update');
$router->get('/admin/orders/{id}/delete', OrderController::class . '@delete');

// Client routes
$router->get('/', HomeController::class . '@index');
$router->get('/products', ProductClientController::class . '@index');
$router->get('/products/{id}', ProductClientController::class . '@show');
$router->post('/cart/add/{id}', CartController::class . '@add');
$router->get('/cart', CartController::class . '@index');
$router->post('/cart/update', CartController::class . '@update');
$router->get('/cart/remove/{id}', CartController::class . '@remove');
$router->get('/checkout', CartController::class . '@checkout');
$router->get('/orders', OrderClientController::class . '@index');
$router->get('/orders/{id}', OrderClientController::class . '@show'); 

$router->run();
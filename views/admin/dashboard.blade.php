@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <h1>Chào Mừng Đến Với Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Danh Mục</h5>
                    <p class="card-text">Tổng: {{ $totalCategories }}</p>
                    <a href="/admin/categories" class="btn btn-light">Quản Lý</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Sản Phẩm</h5>
                    <p class="card-text">Tổng: {{ $totalProducts }}</p>
                    <a href="/admin/products" class="btn btn-light">Quản Lý</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Người Dùng</h5>
                    <p class="card-text">Tổng: {{ $totalUsers }}</p>
                    <a href="/admin/users" class="btn btn-light">Quản Lý</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Đơn Hàng</h5>
                    <p class="card-text">Tổng: {{ $totalOrders }}</p>
                    <a href="/admin/orders" class="btn btn-light">Quản Lý</a>
                </div>
            </div>
        </div>
    </div>
@endsection
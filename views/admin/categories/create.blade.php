@extends('admin.layout')

@section('title', 'Thêm Danh Mục')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/categories">Danh Mục</a></li>
    <li class="breadcrumb-item active">Thêm Mới</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Thêm Danh Mục Mới</h3>
        </div>
        <div class="card-body">
            <form action="/admin/categories/store" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Thêm</button>
            </form>
        </div>
    </div>
@endsection
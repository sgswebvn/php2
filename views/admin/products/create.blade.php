@extends('admin.layout')

@section('title', 'Thêm Sản Phẩm')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/products">Sản Phẩm</a></li>
    <li class="breadcrumb-item active">Thêm Mới</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Thêm Sản Phẩm Mới</h3>
        </div>
        <div class="card-body">
            <form action="/admin/products/store" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh Mục</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option selected disabled>Chọn Danh Mục</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Tồn Kho</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="mb-3">
                    <label for="img_thumbnail" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
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
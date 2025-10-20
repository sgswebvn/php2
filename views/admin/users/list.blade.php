@extends('admin.layout')

@section('title', 'Danh Sách Người Dùng')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active">Người Dùng</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Danh Sách Người Dùng</h3>
            <a href="/admin/users/create" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i>Thêm Mới</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Loại</th>
                        <th>Tạo Lúc</th>
                        <th>Cập Nhật Lúc</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u['id'] }}</td>
                            <td>{{ $u['name'] }}</td>
                            <td>{{ $u['email'] }}</td>
                            <td>{{ $u['type'] }}</td>
                            <td>{{ $u['created_at'] }}</td>
                            <td>{{ $u['updated_at'] }}</td>
                            <td>
                                <a href="/admin/users/{{ $u['id'] }}/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Sửa</a>
                                <a href="/admin/users/{{ $u['id'] }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn?')"><i class="bi bi-trash"></i> Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if ($paginator['current_page'] > 1)
                        <li class="page-item"><a class="page-link" href="?page={{ $paginator['current_page'] - 1 }}">Previous</a></li>
                    @endif
                    @for ($i = 1; $i <= $paginator['total_pages']; $i++)
                        <li class="page-item @if ($i == $paginator['current_page']) active @endif"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                    @endfor
                    @if ($paginator['current_page'] < $paginator['total_pages'])
                        <li class="page-item"><a class="page-link" href="?page={{ $paginator['current_page'] + 1 }}">Next</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
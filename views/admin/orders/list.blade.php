@extends('admin.layout')

@section('title', 'Danh Sách Đơn Hàng')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active">Đơn Hàng</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Danh Sách Đơn Hàng</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Tạo Lúc</th>
                        <th>Cập Nhật Lúc</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $o)
                        <tr>
                            <td>{{ $o['id'] }}</td>
                            <td>{{ $o['user_id'] }}</td>
                            <td>{{ number_format($o['total_amount'], 2) }} $</td>
                            <td>{{ $o['status'] }}</td>
                            <td>{{ $o['created_at'] }}</td>
                            <td>{{ $o['updated_at'] }}</td>
                            <td>
                                <a href="/admin/orders/{{ $o['id'] }}/view" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Xem</a>
                                <a href="/admin/orders/{{ $o['id'] }}/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Sửa</a>
                                <a href="/admin/orders/{{ $o['id'] }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn?')"><i class="bi bi-trash"></i> Xóa</a>
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
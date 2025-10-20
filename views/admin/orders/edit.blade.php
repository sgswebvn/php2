@extends('admin.layout')

@section('title', 'Sửa Đơn Hàng')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/orders">Đơn Hàng</a></li>
    <li class="breadcrumb-item active">Sửa</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Sửa Đơn Hàng #{{ $order['id'] }}</h3>
        </div>
        <div class="card-body">
            <form action="/admin/orders/{{ $order['id'] }}/update" method="POST">
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng Thái</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="pending" @if ($order['status'] == 'pending') selected @endif>Pending</option>
                        <option value="processing" @if ($order['status'] == 'processing') selected @endif>Processing</option>
                        <option value="completed" @if ($order['status'] == 'completed') selected @endif>Completed</option>
                        <option value="cancelled" @if ($order['status'] == 'cancelled') selected @endif>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Cập Nhật</button>
            </form>
        </div>
    </div>
@endsection
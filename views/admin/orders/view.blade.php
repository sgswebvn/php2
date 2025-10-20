@extends('admin.layout')

@section('title', 'Chi Tiết Đơn Hàng')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/orders">Đơn Hàng</a></li>
    <li class="breadcrumb-item active">Chi Tiết</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Chi Tiết Đơn Hàng #{{ $order['id'] }}</h3>
        </div>
        <div class="card-body">
            <p>Tổng Tiền: {{ number_format($order['total_amount'], 2) }} $</p>
            <p>Trạng Thái: {{ $order['status'] }}</p>
            <h4>Sản Phẩm</h4>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Sản Phẩm ID</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['product_id'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'], 2) }} $</td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 2) }} $</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
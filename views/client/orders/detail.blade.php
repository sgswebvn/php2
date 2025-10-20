@extends('layout')

@section('title', 'Chi Tiết Đơn Hàng')

@section('content')
    <h1>Chi Tiết Đơn Hàng #{{ $order['id'] }}</h1>
    <p>Tổng Tiền: {{ number_format($order['total_amount'], 2) }} $</p>
    <p>Trạng Thái: {{ $order['status'] }}</p>
    <h2>Sản Phẩm</h2>
    <table class="table table-striped">
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
@endsection
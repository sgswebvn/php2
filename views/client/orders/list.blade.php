@extends('layout')

@section('title', 'Danh Sách Đơn Hàng')

@section('content')
    <h1>Danh Sách Đơn Hàng Của Bạn</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
                <th>Tạo Lúc</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $o)
                <tr>
                    <td>{{ $o['id'] }}</td>
                    <td>{{ number_format($o['total_amount'], 2) }} $</td>
                    <td>{{ $o['status'] }}</td>
                    <td>{{ $o['created_at'] }}</td>
                    <td><a href="/orders/{{ $o['id'] }}" class="btn btn-info btn-sm">Xem Chi Tiết</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
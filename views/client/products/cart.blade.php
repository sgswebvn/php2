@extends('layout')

@section('title', 'Giỏ Hàng')

@section('content')
    <h1>Giỏ Hàng</h1>
    @if (empty($items))
        <p>Giỏ hàng trống.</p>
    @else
        <form action="/cart/update" method="POST">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['product']['name'] }}</td>
                            <td><input type="number" name="quantity[{{ $item['product']['id'] }}]" value="{{ $item['quantity'] }}" min="1" class="form-control"></td>
                            <td>{{ number_format($item['product']['price'], 2) }} $</td>
                            <td>{{ number_format($item['subtotal'], 2) }} $</td>
                            <td><a href="/cart/remove/{{ $item['product']['id'] }}" class="btn btn-danger btn-sm">Xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Mã Giảm Giá">
                        <button class="btn btn-outline-secondary" type="button">Áp Dụng</button>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <p>Tổng Tiền: {{ number_format($total, 2) }} $</p>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="/checkout" class="btn btn-success">Thanh Toán</a>
                </div>
            </div>
        </form>
    @endif
@endsection
@extends('layout')

@section('title', 'Thanh Toán')

@section('content')
    <h1>Thanh Toán</h1>
    <div class="row">
        <div class="col-md-8">
            <h3>Thông Tin Thanh Toán</h3>
            <form action="/checkout" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="address" required>
                </div>
                <div class="mb-3">
                    <label for="payment" class="form-label">Phương Thức Thanh Toán</label>
                    <select class="form-select" id="payment">
                        <option>COD (Thanh Toán Khi Nhận Hàng)</option>
                        <option>Thẻ Tín Dụng</option>
                        <option>Chuyển Khoản Ngân Hàng</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Xác Nhận Đơn Hàng</button>
            </form>
        </div>
        <div class="col-md-4">
            <h3>Tóm Tắt Đơn Hàng</h3>
            <p>Tổng Tiền: {{ number_format($total, 2) }} $</p>
            <p>Giảm Giá: 0 $</p>
            <p>Phí Vận Chuyển: 10 $</p>
            <hr>
            <p>Tổng Cộng: {{ number_format($total + 10, 2) }} $</p>
        </div>
    </div>
@endsection
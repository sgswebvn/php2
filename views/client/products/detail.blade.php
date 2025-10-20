@extends('layout')

@section('title', $product['name'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../{{ ($product['img_thumbnail']) }}" class="d-block w-100" alt="{{ $product['name'] }}">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <h1>{{ $product['name'] }}</h1>
            <p>Giá: {{ number_format($product['price'], 2) }} $</p>
            <p>Tồn Kho: {{ $product['stock'] }}</p>
            <p>Mô Tả: {{ $product['description'] }}</p>
            <form action="/cart/add/{{ $product['id'] }}" method="POST">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Số Lượng</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ $product['stock'] }}">
                </div>
                <button type="submit" class="btn btn-success">Thêm Vào Giỏ Hàng</button>
            </form>
        </div>
    </div>
    <h2 class="mt-5">Sản Phẩm Liên Quan</h2>
    <div class="row">
        @foreach ($relatedProducts as $p)
            <div class="col-md-3">
                <div class="product-card mb-4">
                    <img src="../{{ ($p['img_thumbnail']) }}" class="product-img" alt="{{ $p['name'] }}">
                    <h5>{{ $p['name'] }}</h5>
                    <p>{{ number_format($p['price'], 2) }} $</p>
                    <a href="/products/{{ $p['id'] }}" class="btn btn-primary">Chi Tiết</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
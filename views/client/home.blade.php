@extends('layout')

@section('title', 'Trang Chủ')

@section('content')
    <!-- Banner -->
    <div class="banner">
    </div>

    <!-- Slider for Featured Products -->
    <h2 class="mt-5">Sản Phẩm Nổi Bật</h2>
    <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($featuredProducts as $key => $p)
                <div class="carousel-item @if ($key == 0) active @endif">
                    <img src="../{{ ($p['img_thumbnail']) }}" class="d-block w-100" alt="{{ $p['name'] }}" style="height: 400px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $p['name'] }}</h5>
                        <p>{{ number_format($p['price'], 2) }} $</p>
                        <a href="/products/{{ $p['id'] }}" class="btn btn-primary">Chi Tiết</a>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Tabs for Products by Category -->
    <h2 class="mt-5">Sản Phẩm Theo Danh Mục</h2>
    <ul class="nav nav-tabs" id="categoryTabs" role="tablist">
        @foreach ($categories as $key => $c)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if ($key == 0) active @endif" id="cat-{{ $c['id'] }}-tab" data-bs-toggle="tab" data-bs-target="#cat-{{ $c['id'] }}" type="button" role="tab" aria-controls="cat-{{ $c['id'] }}" aria-selected="@if ($key == 0) true @else false @endif">{{ $c['name'] }}</button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="categoryTabContent">
        @foreach ($categories as $key => $c)
            <div class="tab-pane fade @if ($key == 0) show active @endif" id="cat-{{ $c['id'] }}" role="tabpanel" aria-labelledby="cat-{{ $c['id'] }}-tab">
                <div class="row">
                    @foreach ($productsByCategory[$c['id']] as $p)
                        <div class="col-md-3">
                            <div class="product-card mb-4">
                                <img src="./{{ ($p['img_thumbnail']) }}" class="product-img" alt="{{ $p['name'] }}">
                                <h5>{{ $p['name'] }}</h5>
                                <p>{{ number_format($p['price'], 2) }} $</p>
                                <a href="/products/{{ $p['id'] }}" class="btn btn-primary">Chi Tiết</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
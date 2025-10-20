@extends('layout')

@section('title', 'Danh Sách Sản Phẩm')

@section('content')
    <h1>Danh Sách Sản Phẩm</h1>
    <div class="row">
        @foreach ($products as $p)
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
@endsection
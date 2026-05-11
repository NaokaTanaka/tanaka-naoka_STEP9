@extends('app')

@section('title', '商品詳細')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
@vite(['resources/js/like.js'])

  <h1>商品詳細</h1>

  <div class="container">
    @forelse($products as $product)
      <p class="detail_container">商品名：{{ $product->product_name }}</p>
      <p class="detail_container">説明：{{ $product->description }}</p>
      <p class="detail_container">画像：
        @if($product->img_path)
        <img src="{{ asset('storage/'.$product->img_path) }}" alt="{{ $product->product_name}}" class="detail_img">
        {{-- 存在しない場合 --}}
        @else
        画像なし
        @endif
      </p>
      <p class="detail_container">金額：￥{{ $product->price }}</p>
      <p class="detail_container">会社：{{ $product->company->company_name }}</p>

      <div class="mb-3">
        <button id="like-btn" class="like-btn {{ $product->likedBy(Auth::user()) ? 'liked' : '' }}" data-product-id="{{ $product->id }}">
          <i class="fas fa-heart"></i>
        </button>
      </div>

    @endforeach

    <div class="detail-btn">
    <a href="{{ route('product.purchase.form', $product->id) }}" class="btn-sales">カートに追加する</a>
    <a href="{{ route('products') }}" class="btn-back">戻る</a>
  </div>

  </div>
@endsection
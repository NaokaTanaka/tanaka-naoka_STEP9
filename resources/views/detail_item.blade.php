@extends('app')

@section('title', '出品商品詳細')

@section('content')
<div class="container">
  <h1>出品商品詳細</h1>

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
  </div>

  <div class="detail-btn">
    <a href="{{ route('item', $product->id) }}" class="btn-update">編集</a>
    <form action="{{ route('destroy', $product->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？');">削除する</button>
    </form>
    <a href="{{ route('mypage') }}" class="btn-back">戻る</a>
  </div>
  @endforeach

@endsection
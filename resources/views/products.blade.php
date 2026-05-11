@extends('app')

@section('title', '商品一覧')

@section('content')
<div class="container">
  <h1>商品一覧</h1>

  <form action="{{ route('search') }}" method="GET" class="my-3">
    <div class="search-box">
      <input type="text" name="product_name" class="name-input" placeholder="商品名を入力">
      <input type="number" name="price_min" class="price-input" placeholder="最低価格">
      <span class="price-span">～</span>
      <input type="number" name="price_max" class="price-input" placeholder="最高価格">
      <button type="submit" class="btn-search">検索</button>
    </div>
  </form>

    <table border="1" class="table">
      <thead>
        <tr>
          <th>商品番号</th>
          <th>商品名</th>
          <th>商品説明</th>
          <th>画像</th>
          <th>料金(￥)</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->product_name }}</td>
          <td>{{ $product->description }}</td>
          <td>
            @if($product->img_path)
            <img src="{{ asset('storage/'.$product->img_path) }}" alt="{{ $product->product_name}}" class="product_img">
            {{-- 存在しない場合 --}}
            @else
            画像なし
            @endif
          </td>
          <td>{{ $product->price }}</td>
          <td>
            <a href="{{ route('detail.products', $product->id) }}" class="btn-detail">詳細</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center">商品がありません</td>
        </tr>
        @endforelse
      </tbody>
    </table>

</div>
@endsection
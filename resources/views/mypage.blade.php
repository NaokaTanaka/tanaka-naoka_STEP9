@extends('app')

@section('title', 'マイページ')

@section('content')
<div class="container">
  <h1>マイページ</h1>
  <a href="{{ route('account') }}" class="btn-primary">アカウント編集</a>

  <div class="mypage-user">
      <p class="mypage-user-item">ユーザー名: {{ auth()->user()->name }}</p>
      <p class="mypage-user-item">名前: {{ auth()->user()->name_kanji }}</p>
      <p class="mypage-user-item">Eメール: {{ auth()->user()->email }}</p>
      <p class="mypage-user-item">カナ: {{ auth()->user()->name_kana }}</p>
  </div>

  <div>
    <h3>＜出品商品＞</h3>
    <a href="{{ route('registration') }}" class="btn-registration">新規登録</a>
    <table border="1" class="table">
      <thead>
        <tr>
          <th>商品番号</th>
          <th>商品名</th>
          <th>商品説明</th>
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
          <td>{{ $product->price }}</td>
          <td><a href="{{ route('detail_item', $product->id) }}" class="btn-detail">詳細</a></td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center">商品がありません</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div>
    <h3>＜購入した商品＞</h3>
    <table border="1" class="table">
      <thead>
        <tr>
          <th>商品名</th>
          <th>商品説明</th>
          <th>料金(￥)</th>
          <th>個数</th>
        </tr>
      </thead>
      <tbody>
      @forelse($sales as $sale)
        <tr>
          <td>{{ $sale->product->product_name }}</td>
          <td>{{ $sale->product->description }}</td>
          <td>{{ $sale->product->price }}</td>
          <td>{{ $sale->quantity }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center">商品がありません</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
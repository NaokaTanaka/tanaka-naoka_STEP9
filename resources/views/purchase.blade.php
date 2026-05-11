@extends('app')

@section('title', '購入画面')

@section('content')
@vite(['resources/js/dialog.js'])

  <h1>購入画面</h1>
    @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif

  <div class="container">
    <form action="{{ route('product.purchase', $product->id) }}" method="POST">
      @csrf
      <p id="productName" class="detail_container" data-name="{{ $product->product_name }}">商品名：{{ $product->product_name }}</p>
      <p class="detail_container">説明：{{ $product->description }}</p>
      <div class="sail_img">
        @if($product->img_path)
        <img src="{{ asset('storage/'.$product->img_path) }}" alt="{{ $product->product_name}}" class="detail_img">
        {{-- 存在しない場合 --}}
        @else
        画像なし
        @endif
      </div>
      <input type="number" name="quantity" class="quantity" value="1" min="1" max="{{ $product->stock }}">
      <p class="detail_container">金額：￥{{ $product->price }}</p>
      <p class="detail_container">残り：{{ $product->stock }}</p>
      <p class="detail_container">会社：{{ $product->company->company_name }}</p>

      <div class="detail-btn">
        @if($product->stock > 0)
          <button type="button" id="showDialog" class="btn-sales">購入する</button>
            <dialog>
              <p id="confirmText"></p>
              <div class="btn-dialog">
                <button type="button" id="closeDialog" class="closeDialog">キャンセル</button>
                <button type="submit" class="btn-sales" autofocus>購入する</button>
              </div>
            </dialog>
        @else
          <button type="submit" class="btn-sales" disabled>購入する</button>
        @endif
        <a href="{{ route('detail.products', $product->id) }}" class="btn-back">戻る</a>
      </div>
    </form>
  </div>
@endsection
@extends('app')

@section('title', '商品登録')

@section('content')
<div class="container">
    <h1>商品登録</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('products') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <label for="product_name">商品名</label>
        <input type="text" name="product_name" id="product_name" class="form-control">
        <label for="price">価格</label>
        <input type="number" name="price" id="price" class="form-control">
        <label for="description">商品説明</label>
        <textarea name="description" id="description" class="form-control"></textarea>
        <label for="stock">在庫数</label>
        <input type="number" name="stock" id="stock" class="form-control">
        <label for="img_path">商品画像</label>
        <input type="file" name="img_path" id="img_path"></input>
      <div class="mt-3">
        <a href="{{ route('mypage') }}" class="btn-back">戻る</a>
        <button type="submit" class="btn-primary">登録
        </button>
      </div>
    </form>
</div>
@endsection
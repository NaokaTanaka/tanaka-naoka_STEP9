@extends('app')

@section('title', '出品商品編集')

@section('content')
<div class="container">
    <h1>出品商品編集</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('item.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

        <label for="product_name">商品名</label>
        <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}">

        <label for="price">価格</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">

        <label for="description">商品説明</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>

        <label for="stock">在庫数</label>
        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}">

        <div class="img-control">
          <label for="img_path">商品画像</label>
          @if($product->img_path)
          <img src="{{ asset('storage/' . $product->img_path) }}" alt="Current img_path" class="item_img">
          @endif
          <input type="file" name="img_path">
        </div>

      <div class="mt-3">
        <a href="{{ route('detail_item', $product->id) }}" class="btn-back">戻る</a>
        <button type="submit" class="btn-update">更新</button>
      </div>
    </form>

</div>
@endsection
@extends('app')

@section('title', 'アカウント編集')

@section('content')
<div class="container">
    <h1>アカウント情報編集</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{ route('account.update') }}" method="POST">
      @csrf
        <label for="name">ユーザー名</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
        <label for="email">Eメール</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
        <label for="name">名前</label>
        <input type="text" name="name_kanji" id="name_kanji" class="form-control" value="{{ old('name_kanji', $user->name_kanji) }}">
        <label for="name">カナ</label>
        <input type="text" name="name_kana" id="name_kana" class="form-control" value="{{ old('name_kana', $user->name_kana) }}">
      <div class="mt-3">
        <a href="{{ route('mypage') }}" class="btn-back">戻る</a>
        <button type="submit" class="btn-update">更新</button>
      </div>
    </form>
</div>
@endsection
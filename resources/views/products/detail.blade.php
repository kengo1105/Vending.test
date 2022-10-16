@extends('layouts.template')
@section('title','商品情報詳細')
@section('content')
<div class="container">
    <div class="row">
        <h2>商品情報詳細</h2>
            <div class="form-group">
                <label for="id">ID:{{ $products->id }}</label>
            </div>

            <div class="form-group">
                <label for="img_path">画像：<img class="detail-img" src="{{ \Storage::url($products->img_path) }}"></label>
            </div>

            <div class="form-group">
                <label for="title" class="pro-name">商品名：{{ $products->product_name }}</label>
            </div>

            <div class="form-group">
                <label for="company_name">メーカー名：{{ $products->company->company_name }}</label>
            </div>

            <div class="form-group">
                <label for="price">価格：{{ $products->price }}</label>
            </div>

            <div class="form-group">
                <label for="stock">在庫数：{{ $products->stock }}</label>
            </div>

            <div class="form-group">
                <label for="comment" class="comment">コメント：{{ $products->comment }}</label>
            </div>

            <button type="button" class="btn btn-default" onclick="location.href='/products/edit/{{ $products->id }}'">編集</button>
    </div>
    <a class="button" href="{{ route('products.list') }}">戻る</a>
</div>
@endsection
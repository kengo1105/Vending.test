@extends('layouts.template')
@section('title','商品一覧')
@section('content')
<div class="row">
        <h1>商品一覧</h1>
    <div class="container">
        <form form method="GET" action="{{ route('products.list') }}">
            <div class="form-group">
                <label for="title">商品名</label>
                <input type="text" class="form-control" id="title" name="product_name" placeholder="商品名" value="{{ old('product_name') }}">
            </div>
            <div class="form-group row">
                <label for="company_id">メーカー名</label>
                <select name="company_id" class="form-control">
                    <option value="">未選択</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">
                    {{ $company->company_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">検索</button>
            </div>
        </form>
        <a class="button" href="{{ route('create') }}">新規登録</a>
        <div class="content">
            @if (!empty($products))
            <div class="productTable">
                <p>全{{ $products->count() }}件</p>
            <table class="table table-hover">
                <thead style="background-color: #ffd900">
                <tr>
                <th>ID</th>
                    <th style="width:50%">商品名</th>
                    <th>画像</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td><img src="{{ Storage::url($product->img_path) }}"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td><a href="#" class="btn btn-primary btn-sm">商品詳細</a></td>
                    <td><input type="submit" class="delbtn" value="削除"></td>
                </tr>
                @endforeach
            </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
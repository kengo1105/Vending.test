@extends('layouts.template')
@section('title','商品一覧')
@section('content')
<div class="row">
        <h1>商品一覧</h1>
    <div class="container">
        <form form method="GET" action="{{ route('products.list') }}">
            <div class="form-group">
                <label for="title">商品名</label>
                <input type="text" class="form-control" id="title" name="product_name" placeholder="商品名" value="{{ request('product_name') }}">
            </div>
            <div class="form-group">
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
                <button class="button1" type="submit">検索</button>
            </div>
        </form>
        <a class="button2" href="{{ route('create') }}">新規登録</a>
        <div class="content">
            @if (!empty($products))
            <div class="productTable">
                <p>全{{ $products->count() }}件</p>
            <table class="table table-hover">
                <thead class="style-label">
                <tr>
                <th>ID</th>
                    <th class="style-1">商品名</th>
                    <th >画像</th>
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
                    <td><img class="img" src="{{ \Storage::url($product->img_path) }}"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td><a class="detbtn" href="{{ route('products.detail', $product->id) }}" >商品詳細</a></td>
                    <td>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" onclick="return checkDelete();">
                            @csrf
                            <button type="submit" class="delbtn">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
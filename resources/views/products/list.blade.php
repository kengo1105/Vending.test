@extends('layouts.template')
@section('title','商品一覧')
@section('content')
<div class="row">
    <h1>商品一覧</h1>
    <div class="container">
        <form form method="GET" action="{{ route('products.list') }}">
            <div class="form-group">
                <label for="product_name">商品名</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="商品名" value="{{ request('product_name') }}">
            </div>
            <div class="form-group">
                <label for="company_id">メーカー名</label>
                <select name="company_id" id ="company_id" class="form-control">
                    <option value="">未選択</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">
                        {{ $company->company_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button id="search_buttom" class="button1" type="button">検索</button>
            </div>
            <a class="button2" href="{{ route('create') }}">新規登録</a>
        </form>
        <div class="content">
            @if (!empty($products))
            <div id="all_show_result" class="productTable">
                <p>全{{ $products->count() }}件</p>
            <table class="table table-hover">
                <tbody>
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
                    <tr class="products-list">
                        <td class="p-list1">{{ $product->id }}</td>
                        <td class="p-list2">{{ $product->product_name }}</td>
                        <td class="p-list3"><img class="img" id="gazou" src="{{ \Storage::url($product->img_path) }}"></td>
                        <td class="p-list4">{{ $product->price }}</td>
                        <td class="p-list5">{{ $product->stock }}</td>
                        <td class="p-list6">{{ $product->company_name }}</td>
                        <td class="p-list7"><a class="detbtn" href="{{ route('products.detail', $product->id) }}">商品詳細</a></td>
                        <td class="p-list8">
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" onclick="return checkDelete();">
                                @csrf
                                <button type="submit" class="delbtn">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
        <div class = "footer">{*フッター部分*}
        <div class = "footer-wrap">
            <ul>
                <li><a href="cat1/index.html">{$ary[0]}</a></li>
                <li><a href="cat2/index.html">{$ary[1]}</a></li>
                <li><a href="cat3/index.html">{$ary[2]}</a></li>
            </ul>
        </div>    
    </div>
    </div>
</div>
@endsection
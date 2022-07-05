@extends('vending')
@section('title','自動販売機の売り上げ管理')
@section('content')
<div class="row">
        <h1>商品一覧</h1>
    <div class="container">
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
                </tr>
                </thead>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>                    
                    <td><img src="{{ Storage::url($product->img_path) }}"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td><a href="#" class="btn btn-primary btn-sm">商品詳細</a></td>
                </tr>
                @endforeach    
                    
                
            </table>
            </div>
            
            @endif
            
        </div>
    </div>
    
</div>
@endsection
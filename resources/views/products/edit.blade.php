@extends('layouts.template')
@section('title','商品情報編集')
@section('content')
<form action="{{ route('update', $products['$id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img_path">画像：<img src="{{ \Storage::url($products->img_path) }}" width="75"></label>
        </div>
        <div class="form-group">
            <label for="product_name">商品名:</label>
            <input type="text" class="form-control" id="title" name="product_name" value="{{ $products->product_name }}">
            @if($errors->has('product_name'))
                <p>{{ $errors->first('product_name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <div>
                <label for="company_name">メーカー名：</label>
                <select name="company_id" value="メーカー">
                    @foreach($companies as $company)
                        @if ($company->id === $products->company_id)
                            <option value="{{ $company->id }}" selected>{{ $company->company_name }}</option>
                        @else
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('company_name'))
                    <p>{{ $errors->first('company_name') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="price">価格：</label>
                <input type="text" name="price" value="{{ $products->price }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="stock">在庫数：</label>
                <input type="text" name="stock" value="{{ $products->stock }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea class="form-control" id="comment" name="comment">{{ $products->comment }}</textarea>
            @if($errors->has('comment'))
                <p>{{ $errors->first('comment') }}</p>
            @endif
        </div>
        <input type="hidden" name="id" value="{{ $products->id }}">
        <input type="file" name="img_path">
        <button type="submit" class="btn btn-default">更新</button>
</form>
<a class="button" href="{{ route('products.detail', $products->id) }}">戻る</a>
@endsection('content')

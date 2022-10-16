@extends('layouts.template')
@section('title','商品情報登録')
@section('content')
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">商品名:</label>
            <input type="text" class="form-control" id="title" name="product_name" placeholder="商品名" value="{{ old('product_name') }}">
            @if($errors->has('product_name'))
                <p>{{ $errors->first('product_name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="company_name">メーカー:</label>
            <select name="company_id" class="form-control">
                    <option value="">未選択</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">
                    {{ $company->company_name }}
                    </option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <div>
                <label for="price">価格：</label>
                <input type="text" name="price" placeholder="価格" value="{{ old('price') }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="stock">在庫数：</label>
                <input type="text" name="stock" placeholder="在庫数" value="{{ old('stock') }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea class="form-control" id="comment" name="comment" placeholder="Comment">{{ old('comment') }}</textarea>
            @if($errors->has('comment'))
                <p>{{ $errors->first('comment') }}</p>
            @endif
        </div>

        <input type="file" name="img_path">
        <button type="submit" class="btn btn-default">登録</button>
</form>
<a class="button" href="{{ route('products.list') }}">戻る</a>
@endsection('content')

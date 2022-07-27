@extends('layouts.template')
@section('title','商品情報登録')
@section('content')
<form action="/upload" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label for="title">商品名:</label>
            <input type="text" class="form-control" id="title" name="searchWord" placeholder="商品名">
        </div>
        <div class="form-group">
            <label for="companyId">メーカー:</label>
            <select name="companyId" value="メーカー" required>
                <option value="1">メーカー1</option>
                <option value="2">メーカー2</option>
                <option value="3">メーカー3</option>
                <option value="4">メーカー4</option>
            </select>
        </div>
        <div class="form-group">
            <div>
                <label for="price">価格：</label>
                <input type="text" name="price" placeholder="価格">
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="price">在庫数：</label>
                <input type="text" name="stock" placeholder="在庫数">
            </div>
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea class="form-control" id="comment" name="comment" placeholder="Comment"></textarea>
        </div>

        <input type="file" name="image">
        <input type="submit" value="アップロード">
</form>
@endsection('content')

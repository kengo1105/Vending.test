@extends('vending')
@section('title','商品情報登録')
@section('content')
<form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="form-group">
            <label for="title">商品名</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="商品名">
        </div>

        <div class="form-group">
            <label for="companyId">メーカー</label>
            <select name="companyId" value="メーカー" required>
                <option value="1">メーカー1</option>
                <option value="2">メーカー2</option>
                <option value="3">メーカー3</option>
                <option value="4">メーカー4</option>
            </select>
            <input type="text" class="form-control" id="url" name="url" placeholder="">
        </div>

        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea class="form-control" id="comment" name="comment" placeholder="Comment"></textarea>
        </div>

        <input type="file" name="img_path">
        <input type="submit" value="アップロード">
</form>
@endsection('content')

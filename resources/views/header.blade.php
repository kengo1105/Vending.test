<header>
    <h1 class="headline">
        <a>自動販売機</a>
    </h1>
    <form form method="GET" action="{{ route('searchproduct')}}">   

            <div class="form-group">
                <label for="title">商品名</label>
                <input type="text" class="form-control" id="title" name="searchWord" placeholder="商品名">
            </div>

            <div class="form-group row">
                <label for="company_id">メーカー名</label>
                <select name="companyId" class="form-control" value="{ $companyId }">
                    <option value="">未選択</option>
                    @foreach($companies as $id => $company_name)
                    <option value="{{ $id }}">
                    {{ $company_name }}
                    </option>  
                    @endforeach
                </select>    
            </div>
        <button class="btn btn-primary" type="submit">検索</button>
        <button type="submit" onclick="location.href='./item.create'">新規登録</button>
    </form>
        
    
</header>

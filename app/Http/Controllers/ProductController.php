<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    public function showList() {
        $model = new Product();

        $products = $model->getList();

        return view('/products/list', ['products' => $products]);
    }

    public function showRegistForm() {
        return view('regist');
    }

    public function index()
    {
        return view('product.index');
    }

    public function create(Request $request)
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $img = $request->file('img_path');
        // 画像情報がセットされていれば、保存処理を実行
        if (isset($img)) {
            // storage > public > img配下に画像が保存される
            $path = $img->store('img','public');
            // store処理が実行できたらDBに保存処理を実行
            if ($path) {
                // DBに登録する処理
                Product::create([
                    'img_path' => $path,
                ]);
            }
        }

        //　リダイレクト
        return redirect()->route('item.index');
    }

    public function show(Request $request)
    {
        $company = new Company;
        $companies = $company->getLists();
        $searchWord = $request->input('searchWord');
        $companyId = $request->input('companyId');

        return view('/products/list', [
            'companies' => $companies,
            'searchWord' => $searchWord,
            'companyId' => $companyId
        ]);
    }

    public function search(Request $request)
    {
        //入力される値nameの中身を定義する
        $searchWord = $request->input('searchWord'); //商品名の値
        $companyId = $request->input('companyId'); //カテゴリの値

        $query = Product::query();
        //商品名が入力された場合、m_productsテーブルから一致する商品を$queryに代入
        if (isset($searchWord)) {
            $query->where('product_name', 'like', '%' . self::escapeLike($searchWord) . '%');
        }
        //カテゴリが選択された場合、m_categoriesテーブルからcategory_idが一致する商品を$queryに代入
        if (isset($companyId)) {
            $query->where('company_id', $companyId);
        }

        //$queryをcategory_idの昇順に並び替えて$productsに代入
        $products = $query->orderBy('company_id', 'asc')->paginate(4);

        //m_categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
        $company = new Company;
        $companies = $company->getLists();

        return view('/products/list', [
            'products' => $products,
            'companies' => $companies,
            'searchWord' => $searchWord,
            '$companyId' => $companyId
        ]);
    }
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
        // $posts = Post::where('title', 'like', "%{$request->search}%")
                // ->orWhere('content', 'like', "%{$request->search}%")
                // ->paginate(3);

        // return view('searchproduct', [
        //     'posts' => $posts,
        //     'search_result' => $search_result,
        //     'search_query'  => $request->search
        // ]);
    
}

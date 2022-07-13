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
        $companies = Company::all();

        return view('/products/list', [
            'products' => $products, 
            'companies' => $companies
        ]);
    }

    public function showRegistForm() {
        return view('regist');
    }

    public function createForm() {
        return view('/products/create');
    }

    public function index()
    {
        return view('/products/index');
    }

    // public function create(Request $request)
    // {
    //     return view('/products/create');
    // }

    
    public function upload(Request $request)
    {
        $dir = 'storage';
        $file_name = $request->file('img_path')->getClientOriginalName();
        $request->file('img_path')->storeAs('public/'. $dir, $file_name);

        // ファイル情報をDBに保存
        $image = new Product();
        $image->img_path = 'storage/' . $dir . '/' . $file_name;
        $image->save();
        //　リダイレクト
        return redirect('/');
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
        $products = $query->orderBy('company_id', 'asc')->paginate(10);

        //m_categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
        $company = new Company;
        $companies = $company->getLists();

        return view('/products/list', [
            'products' => $products,
            'companies' => $companies,
            'searchWord' => $searchWord,
            'companyId' => $companyId
        ]);
    }
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
}

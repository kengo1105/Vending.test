<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Product extends Model
{
    public function getList($request) {
        // dd($request->input('product_name'));
        $products = DB::table('products')->join('companies', 'products.company_id', '=', 'companies.id');
        if (isset($request->product_name)) {
            $products->where('product_name', 'like', '%' . $request->product_name . '%');
            // dd($products->toSql());
        }
        //カテゴリが選択された場合、m_categoriesテーブルからcategory_idが一致する商品を$productsに代入
        if (isset($request->company_id)) {
            $products->where('company_id', $request->company_id);
        }
        
        return $products->get();
    
    }

    protected $table = 'products';

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'img_path',
    ];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }
    public function company() {
        return $this->belongsTo(Company::class);
    }    
}

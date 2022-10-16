<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'img_path',
        'comment',
    ];

    public function getList($request) {
        $products = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
        ->select('products.*', 'products.id', 'companies.company_name');
        if (isset($request->product_name)) {
            $products->where('product_name', 'like', '%' . $request->product_name . '%');
        }
        if (isset($request->company_id)) {
            $products->where('company_id', $request->company_id);
        }
        return $products->get();
    }

    public function sale() {
        return $this->belongsTo(Sale::class);
    }
    
    public function company() {
        return $this->belongsTo(Company::class);
    }    
}

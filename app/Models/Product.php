<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList() {
        
        $products = DB::table('products')
                ->join('companies', 'products.company_id', '=', 'companies.id')
                ->get();

        return $products;
        
    }

    protected $table = 'products';

    protected $fillable = [
        'img_path',
    ];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }
    public function company() {
        return $this->belongsTo(Company::class);
    }    
}

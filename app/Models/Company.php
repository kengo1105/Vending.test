<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public function getLists()
    {
        $companies = DB::table('companies')
        ->join('products', 'products.company_id', '=', 'companies.id')
        ->get();
        $companies = Company::pluck('company_name', 'id');

        return $companies;
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}

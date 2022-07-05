<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public function getLists()
    {
        $companies = Company::pluck('company_name', 'id');

        return $companies;
    }
    public function Products() {
        return $this->hasMany(Product::class);
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name',
    ];

    public function getList() {
        $companies = DB::table('companies');

        return $companies->get();
    }
    
    public function products() {
        return $this->hasMany(Product::class);
    }
}

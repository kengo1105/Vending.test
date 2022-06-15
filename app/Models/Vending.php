<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vending extends Model
{
    public function getList() {
        
        $vendings = DB::table('vending.test')->get();
        return $vendings;
        
    }

}
?>
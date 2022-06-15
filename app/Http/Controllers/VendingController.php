<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vending;
class VendingController extends Controller
{
    public function showList() {
        $model = new Vending();

        $vendings = $model->getList();

        return view('vending', ['vending' => $vendings]);
    }
}

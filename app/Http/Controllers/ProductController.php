<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    public function showList(Request $request) {
        $product_model = new Product();
        $products = $product_model->getList($request);
        $company_model = new Company;
        $companies = $company_model->getList();
        return view('/products/list', [
            'products' => $products,
            'companies' => $companies
        ]);
    }
    public function show(Request $request) {
        $company = new Company;
        $companies = $company->getList();
        $products = $request->input('product_name');
        $company_id = $request->input('company_id');
        return view('/products/list', [
            'companies' => $companies,
            'product_name' => $products,
            'company_id' => $company_id
        ]);
    }

    public function search(Request $request) {
        $request->product_name = $request->input('product_name');
        $request->company_id = $request->input('company_id'); 
        $company = new Company;
        $companies = $company->getList();
        return view('/products/list', [
            'products' => $products,
            'companies' => $companies,
            'company_id' => $company_id
        ]);
    }
    public function showDetail($id) {
        $products = Product::find($id);
        if (is_null($products)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products.list'));
        }
        return view('/products/detail', [
            'products' => $products
        ]); 
    }

    public function showEdit($id) {
        $products = Product::find($id);
        $company_model = new Company;
        $companies = $company_model->getList();
        if (is_null($products)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products.list'));
        }
        return view('/products/edit', [
            'products' => $products,
            'companies' => $companies
        ]); 
    }

    public function createForm() {
        $company_model = new Company;
        $companies = $company_model->getList();
        
        return view('/products/create', [
            'companies' => $companies
        ]);
    }

    public function store(ProductRequest $request) {
        DB::beginTransaction();
        try {
            $img_name = $request->file('img_path')->getClientOriginalName();
            if (isset($img_name)) {
                $img_path = Storage::putFileAs('/public',$request->file('img_path'), $img_name);
                if ($img_path) {
                    Product::create([
                        'company_id' => $request->company_id,
                        'product_name' => $request->product_name,
                        'price' => $request->price,
                        'stock' => $request->stock,
                        'comment' => $request->comment,
                        'img_path' => $img_path
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect(route('products.list'));
    }

    public function update(ProductRequest $request) {
        $inputs = $request -> all();
        DB::beginTransaction();
        try {
            $img_name = $request->file('img_path')->getClientOriginalName();
            if (isset($img_name)) {
                $img_path = Storage::putFileAs('/public',$request->file('img_path'), $img_name);
                if ($img_path) {
                    $product_model = Product::find($inputs['id']);
                    $product_model -> fill([
                        'id' => $request->id,
                        'company_id' => $request->company_id,
                        'product_name' => $request->product_name,
                        'price' => $request->price,
                        'stock' => $request->stock,
                        'comment' => $request->comment,
                        'img_path' => $img_path
                    ]);
                }
            }
            $product_model->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect(route('products.list'));
    }
  public function destroy(Request $request, $id) {
    try {    
        DB::table("products")
        ->where('id',$id)
        ->delete();
        } catch (\Exception $e) {
            return back();
        }
        return redirect()->route('products.list');
    }  
 }
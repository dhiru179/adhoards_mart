<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product_category.index');
    }
    function create()
    {
        $product_category = DB::table('product_category')->where(['parent_id'=>null])->get();
        return view('admin.product_category.add', compact(['product_category']));
    }
    function store(Request $request)
    {
        $data = [
            'status'=>true,
        ];

        $get_data = [];
        $product_category = $request->category;
        $parent_id = $request->parent_id;
        foreach ($product_category as $key => $value) {
            $get_data[] = [
                'name' => $value,
                'parent_id'=>$parent_id,
            ];
        }
        
        DB::table('product_category')->insert($get_data);
        $data['msg']='suucess';
        return $data;
       
    }
}

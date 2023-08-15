<?php

namespace App\Http\Controllers\Mart;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $product_category = DB::table('product_category')->get(['id','name','parent_id']);
        $compact = [
            'product_category'=>$product_category,
        ];
        return view('mart.home',$compact);
    }
}

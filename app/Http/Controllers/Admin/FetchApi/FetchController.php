<?php

namespace App\Http\Controllers\Admin\FetchApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FetchController extends Controller
{

    function getProductCategory(Request $request)
    {
        $data = [
            'status' => true,
        ];
        $id = $request->current_id;
        $product_category =  DB::table('product_category')->where(['parent_id' => $id])->get();
        $data['msg'] = 'success';
        $data['data'] = $product_category;
        return $data;
    }
}

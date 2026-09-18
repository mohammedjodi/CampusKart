<?php

namespace App\Controllers\Products;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductsController extends BaseController
{
    public function index()
    {
        
    }

    public function create(){
        return view('pages/create');

    }

    public function details(){
        return view('pages/create_details');
    }

    public function show($product_id){
        return view('pages/show-product');
    }

   


}

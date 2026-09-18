<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
    //     dd([
    //         // 'viewPath' => config('views')->paths,
    //         'header' => APPPATH . 'Views/components/header.php',
    //         'exists' => file_exists(APPPATH .'Views/components/header.php' ),
    //     ]);
        return view('pages/index');
    }
}

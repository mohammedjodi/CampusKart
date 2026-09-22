<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = auth()->user();

        $universityModel = new \App\Models\UniversitiesModel();
        $stateModel = new \App\Models\StatesModel();

        $university = $universityModel->find($user->university_id);
        $state = $stateModel->find($user->state_id);

        return view('pages/profile',[
            'user' => $user,
            'university' => $university,
            'state' => $state ,
        ]);
        
    }
}

<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

// Shield controller
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Events\Events;

// states and University Models
use App\Models\StatesModel;
use App\Models\UniversitiesModel;


class RegisterController extends ShieldRegisterController
{
    /**
     * Attempts to register the user.
     */
    //customizing this method to acccept our custom fields validate them and insert in to the db 
    public function registerAction(): RedirectResponse
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        // Check if registration is allowed
        if (! setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        //upload the avatar after validation 
        $avatar = $this->request->getFile('avatar');
    
        // $avatarName = null;
        if($avatar->isValid() && !$avatar->hasMoved()){
            //rename the avatar to be unique 
            $avatarName = $avatar->getRandomName();
            //move the avatar 
            $avatar->move(FCPATH . 'public/uploads/avatars' , $avatarName);
            $avatarPath = 'uploads/avatars/' . $avatarName;

        }

        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        
        // dd($this->request->getPost());
        // Save the user
        $allowedPostFields = array_keys($rules);
        $user              = $users->createNewUser($this->request->getPost($allowedPostFields));
        //Grab our custom fields from the post 
        $user->first_name= $this->request->getPost('first_name');
        $user->last_name= $this->request->getPost('last_name');
        // $user->university= $this->request->getPost('university');
        $user->avatar= $avatarPath;
        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        try {
            $users->save($user);
        } catch (ValidationException) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        Events::trigger('register', $user);

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        $authenticator->startLogin($user);

        // If an action has been defined for register, start it up.
        $hasAction = $authenticator->startUpAction('register', $user);
        if ($hasAction) {
            return redirect()->route('auth-action-show');
        }

        // Set the user active
        $user->activate();

        $authenticator->completeLogin($user);

        // Success!
        return redirect()->to(config('Auth')->registerRedirect())
            ->with('message', lang('Auth.registerSuccess'));
    }

    public function registerView()
    {
        // Sheilds Default checks 
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        // Check if registration is allowed
        if (! setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // If an action has been defined, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show');
        }

        $stateModel = new StatesModel();

        $data = [
            'states' => $stateModel->findAll(),
        ];

        //return shields view but append our cutom data to it 
        return $this->view(setting('Auth.views')['register'] , $data);


    }

    public function getValidationRules(): array
    {
        $rules = parent::getValidationRules();

        // Add custom validation rules for the new fields
        $rules['first-name'] = [
            'rules' => 'required|min_length[3]'
        ];
        $rules['last-name'] = [
            'rules' => 'required|min_length[3]'
        ];
        $rules['university_id'] = [
            'rules' => 'required|min_length[3]'
        ];
        $rules['avatar'] = [
            'rules' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]|max_size[avatar,2048]',
            'errors' => [
                'is_image' => 'Avatar must be a JPG or PNG image',
                'mime_in' => 'Avatar must be a JPG or PNG image',
                'max_size' => 'Avatar cannot be larger than 2MB'
            ]
            ];

        return $rules;
    }

    //Returning  a list of universities to a specific state to our js client  
    public function Universities($state_id){
        $universityModel = new UniversitiesModel();

        $universites = $universityModel->where('state_id' , $state_id)->findAll();

        return $this->response->setJSON($universites);
    }
}


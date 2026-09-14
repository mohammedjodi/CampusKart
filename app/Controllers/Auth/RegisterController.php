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

        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        //get the post data 
        $allowedPostFields = array_keys($rules);
        // dd($allowedPostFields);

        $registrationData = $this->request->getPost($allowedPostFields);
        //Remove avatar from the array because we handle it manually
        unset($registrationData['avatar']); 

        //Handle Optional avatar 
        $avatarPath = null ;
        $avatar = $this->request->getFile('avatar');
        if($avatar && $avatar->isValid() && !$avatar->hasMoved()){
            //rename the avatar to be unique 
            $avatarName = $avatar->getRandomName();

            //move the avatar 
            $avatar->move(
                FCPATH . 'uploads/avatars' ,
                $avatarName
                );

            $avatarPath = 'uploads/avatars/' . $avatarName;

        }

        //Add the avatar path back to the registiration data 
        $registrationData['avatar'] = $avatarPath;
        
        // dd($registrationData );
        
        
        // Save the user
        $user = $users->createNewUser($registrationData);
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

        // OVERRIDE SHIELD'S PASSWORD RULE FOR REGISTRATION AJAX
        $rules['password'] = [
            'rules' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/]',
            'errors' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 8 characters',
                'regex_match' => 'Password must contain uppercase, lowercase, number and special character'
            ]
        ];
        $rules['password_confirm'] = [
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => 'Please confirm your password',
                'min_length' => 'Password must be at least 8 characters'
            ]
        ];


        // Add custom validation rules for the new fields
        $rules['first_name'] = [
            'rules' => 'required|min_length[3]'
        ];
        $rules['last_name'] = [
            'rules' => 'required|min_length[3]'
        ];
       
        $rules['university_id'] = [
            'rules' => 'required|is_not_unique[Campuses.id]'
        ];
        $rules['state_id'] = [
            'rules' => 'required|is_not_unique[states.id]'
        ];
        $rules['phone'] = [
            'rules' => 'required|regex_match[/^(?:\+234|0)[789][01]\d{8}$/]|is_unique[users.phone]|max_length[11]|min_length[11]'
        ];
        $rules['bio'] = [
            'rules' => 'permit_empty|max_length[500]'
        ];
        //avatar validation is handled by js locally 
        // $rules['avatar'] = [
        //     'rules' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]|max_size[avatar,2048]',
        //     'errors' => [
        //         'is_image' => 'Avatar must be a JPG or PNG image',
        //         'mime_in' => 'Avatar must be a JPG or PNG image',
        //         'max_size' => 'Avatar cannot be larger than 2MB'
        //     ]
        //     ];

        return $rules;
    }

    //Returning  a list of universities to a specific state to our js client  
    public function Universities($state_id){
        $universityModel = new UniversitiesModel();

        $universites = $universityModel->where('state_id' , $state_id)->findAll();

        return $this->response->setJSON($universites);
    }

    /* 
        This Method gets a request from Ajax which passes
        the `Field` , `value` and then the method proccess
        that request using shields  getValidationRules() and then
        returns the errors if an as a json for the Ajax 
    */
    public function validateField(){
        $field = $this->request->getPost('field');
        $value = $this->request->getPost('value');

        //Get registration validation rules 
        $rules = $this->getValidationRules();

        //Make sure the request field exists 
        if(!isset($rules[$field])) {
            return $this->response->setJSON([
                'valid' => false,
                'message' => "Invalid field",
                   
            ])->setStatusCode(404);
        }

        //create validator 
        $validation = service('validation');

        //give the validator ONLY the rule for this field 
        $validation->setRules(
        [
            $field => $rules[$field]['rules']
        ],
        [
            $field => $rules[$field]['errors'] ?? []
        ]);

        // validate 
        if(! $validation->run([
            $field => $value
        ])){
            
            return $this->response->setJSON([
                'valid' => false,
                'errors' => $validation->getErrors()[$field]
            ]);
        }

        return $this->response->setJSON([
            'valid' => true ,
            'success' => 'Valid*',
            'errors' => [],
        ]);

    }
}


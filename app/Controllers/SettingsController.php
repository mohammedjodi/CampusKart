<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SettingsController extends BaseController
{
    public function index()
    {
        $user = auth()->user();

        $universityModel = new \App\Models\UniversitiesModel();
        $stateModel = new \App\Models\StatesModel();

        $universities = $universityModel->find();
        $states = $stateModel->find();

        return view('pages/settings', [
            'user' => $user ,
            'states' => $states,
            'universities' => $universities,
        ]);
    }

    /* 
        Update User Personal Information
     */
    public function updateProfileDetails()
    {
        $user = auth()->user();

        $rules = [
            'first_name' => 'required|min_length[3]',
            'last_name' => 'required|min_length[3]',
            'bio' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)){
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors(),

            ]);
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'bio' => $this->request->getPost('bio') ?? '',
        ];

        $odlAvatar = $user->avatar;
        $avatar = $this->request->getFile('avatar');

        if($avatar && $avatar->isValid() && ! $avatar->hasMoved()){
            $newName =  $avatar->getRandomName();

            $avatar->move(
                FCPATH . '/uploads/avatars' , 
                $newName 
            );

            $data['avatar'] = 'uploads/avatars/' . $newName ;
        }

        $userModel = model(\App\Models\UserModel::class);

        if(! $userModel->update($user->id , $data)){
           return $this->response->setJSON([
                'status' => false,
                'message' => 'Unable to update your settings.',
            ]); 
        }

        //Delete Old Avatar After Successful Update of the New Avatar 
        if(isset($data['avatar']) && ! empty($odlAvatar)){

            $odlAvatarPath = FCPATH . $odlAvatar;
            if(is_file($odlAvatarPath)){
                unlink($odlAvatarPath);
            }

        }
        

        return $this->response->setJSON([
                'status' => true,
                'message' => 'Personal Information updated successfully..',

            ]);
    }

      /* 
        Update User Account Information
     */
    public function updateAccountInformation()
    {
        $user = auth()->user();

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[30]|alpha_numeric_punct|is_unique[users.username,id,'. $user->id .']',
                'errors' => [
                    'required' => 'Username is required',
                    'min_length' => 'Username must be at alest 3 characters.',
                    'max_length' => 'Username must not exceed 30 characters.',
                    'alpha_numeric_punct' => "Username cannot contian invalid characters.",
                    'is_unique' => 'This username is already taken.' 
                ]
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[auth_identities.secret,user_id,' .$user->id. ']',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'is_unique' => 'Email already taken'
                ],

            ],

            'phone' => [
                'lable' => 'Phone',
                'rules' => 'required|min_length[11]|max_length[11]',
                'errors' => [
                    'required' => 'Phone number is required',
                    'min_length' => 'Phone number is too short.',
                    'max_length' => 'Phone number is too long.',
                ]
            ]
        ];

        if(! $this->validate($rules)){
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'phone' => $this->request->getPost('phone')
        ];

        $userModel = model(\App\Models\UserModel::class);
        //Auth_identies Model
        $userIdentityModel = model(\Codeigniter\Shield\Models\UserIdentityModel::class);

        //Updating Email Seperately cause it stored in auth_identities table and not users 
        $identity = $user->getEmailIdentity();
        $email = $this->request->getPost('email');

        //checking if both the user fields and email field was saved in the db 
        if(! $userModel->update($user->id , $data) || ! $userIdentityModel->update( $identity->id , [ 'secret' => $email ]))
        {
           return $this->response->setJSON([
                'status' => false,
                'message' => 'Unable to update your settings.',
            ]); 
        }

        return $this->response->setJSON([
                'status' => true,
                'message' => 'Account Information updated Successfully..'
            ]);

    }
    /* 
        Update User School Information
     */
    public function updateSchoolInformation()
    {
        $user = auth()->user();

        $rules = [
            'university_id' => [
                'rules' => 'required|is_not_unique[Campuses.id]',
                'errors'=> [
                    'required' => 'Please Select a university',
                ]
            ],
            'state_id' => [
                'rules' => 'required|is_not_unique[states.id]',
                'errors'=> [
                    'required' => 'Please Select a State',
                ]
            ]
        ];
        

        if (!$this->validate($rules)){
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors(),

            ]);
        }

        $data = [
            'state_id' => $this->request->getPost('state_id'),
            'university_id' => $this->request->getPost('university_id'),
        ];

        $userModel = model(\App\Models\UserModel::class);

        if(! $userModel->update($user->id , $data)){
           return $this->response->setJSON([
                'status' => false,
                'message' => 'Unable to update your settings.',
            ]); 
        }

        return $this->response->setJSON([
                'status' => true,
                'message' => 'Personal Information updated successfully..',

            ]);
    }

     /* 
        Update User Password
     */
    public function changePassword()
    {
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $users = auth()->getProvider();
        $user = $users->findByCredentials([
                    'email' => auth()->user()->email,
                ]);
        //Check Current Password 
        if(! password_verify($currentPassword , $user->password_hash)){
            return $this->response->setJSON([
                'status' => false,
                'errors' => [
                    'current_password' => 'Current Password is incorrect.'
                ],
            ]);
        }

        //Check Confirmation
        if($newPassword !== $confirmPassword){
            return $this->response->setJSON([
                'status' => false,
                'errors' => [
                    'confirm_password' => 'Passwords do not match.'
                ],
            ]);
        } 

        //New Passsword Validation Rules 
        $rules = [
            'new_password' => [
                'label'=> 'New Password',
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters',
                    'regex_match' => 'Password must contain uppercase, lowercase, number and atleast 1 special character'
                ]
            ]
        ];

        if(! $this->validateData(
            ['new_password' => $newPassword] , $rules
        )){
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        //Update Password Through Shield 
        $loggedInUser = \auth()->user();

        $loggedInUser->fill([
            'password' => $newPassword
        ]);

        $users->save($loggedInUser);
        return $this->response->setJSON([
                'status' => true,
                'message' => 'Password Updated Successfully.'

            ]);

    }


    
}

<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,

            // add our custom fields for campuskart 
            'first_name',
            'last_name',
            'university_id',
            'phone',
            'bio',
            'state_id',
            'avatar',
        ];
    }
}

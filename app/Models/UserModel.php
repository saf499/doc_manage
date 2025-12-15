<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'SPK_USERS';
    protected $primaryKey = 'ID';
    protected $useAutoIncrement = true;
    protected $useTimestamps = false;
    // protected $createdAtField  = 'CREATED_AT'; // Make sure this matches Oracle
    // protected $updatedAtField = 'UPDATED_AT';

    protected $allowedFields = [
        'NAME', 'EMAIL', 'GENDER', 'AGE', 'PROFILE_PIC', 'RESUME'
    ];
}

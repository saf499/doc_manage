<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table      = 'staf';
    protected $primaryKey = 'staffid';

    protected $allowedFields = [
        'nostaff', 'name', 'email', 'password', 'roles'
    ];

    protected function getUserByUsernameAndPassword($email, $password) {
        $user = $this->where('username', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }

        return $user;
    }
}
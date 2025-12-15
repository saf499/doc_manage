<?php 

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;


class User extends BaseController
{
    public function index()  //localhost:8080/admin/user
    {
        $model = new UserModel();
        $data['staf'] = $model->findAll();

        if ($data !== null) {
            var_dump($data);
        }

        return view('admin/user', $data);
    }
}

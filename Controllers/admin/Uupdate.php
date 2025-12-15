<?php 

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;


class Uupdate extends BaseController
{
    public function ustaff($id){
        $model = new UserModel();
        $data = $this->request->getPost();

        // Validate data

        $model->update($id, $data);

        return redirect()->to('/admin/user'); // Or redirect to a success page
    }
}

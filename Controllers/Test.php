<?php

namespace App\Controllers;

use App\Models\TestM;
use CodeIgniter\Controller;

class Test extends Controller{
    public function index(){
        $model = new TestM();
        $data['test'] = $model->findAll();

        if (empty($data['test'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No projects found');
        }

        return view('/test', $data);
    }

    public function create(){
        return view('/test_create');
    }

    public function store(){
        $model = new TestM();

        $data = [
            'test_tajuk' => $this->request->getPost('test_tajuk'),
            'test_comment' => $this->request->getPost('test_comment'),
            'test_int' => $this->request->getPost('test_int'),
            'test_option' => $this->request->getPost('test_option'),
            'tahun' => $this->request->getPost('tahun')
        ];

        if ($model->insert($data)) {
            return redirect()->to('/test');
        } else {
            echo "Insertion failed.";
            print_r($model->errors());
        }
    }

}
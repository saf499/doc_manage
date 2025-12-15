<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Test extends Controller{
    public function index(){
        return view('/test/home');
    }

    public function projek_list() {
        return view('/test/projek_list');
    }

    public function projek_add(){
        return view('/test/projek_add');
    }
    
    public function projek_detail() {
        return view('/test/projek_detail');
    }

    public function perolehan_add() {
        return view('/test/perolehan_add');
    }

    public function kontraktor() {
        return view('test/kontraktor');
    }
    public function kontraktor_add() {
        return view('/test/kontraktor_add');
    }

    public function kontrak() {
        return view('/test/kontrak');
    }

    public function kontrak_add() {
        return view('/test/kontrak_add');
    }

    public function kontrak_detail(){
        return view('/test/kontrak_detail');
    }

    public function bon(){
        return view('/test/bon');
    }

    public function bon_add(){
        return view('/test/bon_add');
    }

    public function insurans(){
        return view('/test/insurans');
    }

    public function insurans_add(){
        return view('/test/insurans_add');
    }
}
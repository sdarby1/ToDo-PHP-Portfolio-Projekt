<?php

namespace App\Controllers;

use App\BaseController;

class MenuController extends BaseController {
    public function index()
    {
        $this->response->view('menu/index');
    }
}

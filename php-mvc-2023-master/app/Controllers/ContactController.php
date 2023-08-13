<?php

namespace App\Controllers;

use App\BaseController;

class ContactController extends BaseController {
    public function index()
    {
        $this->response->view('contact/index');
    }
}

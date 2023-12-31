<?php

namespace App\Controllers;

use App\BaseController;
use App\Request;
use App\Models\FormValidation;
use App\Models\User;
use App\Helpers\Session;
use Exception;
use App\Traits\HasProtectedRoutes;

class RegisterController extends BaseController {
    use HasProtectedRoutes;

 
    public function index(Request $request)
    {
        $this->redirectAuthenticatedUsers();

        $this->response->view('register/index');
    }

    public function create(Request $request)
    {
        $this->redirectAuthenticatedUsers();

        $formInput = $request->getInput();

        $validation = new FormValidation($formInput);

        $validation->setRules([
            'username' => 'required|min:3|max:64',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'passwordAgain' => 'required|matches:password'
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $this->response->view(
                path: 'register/index',
                data: [
                    'title' => 'Register',
                    'errors' => $validation->getErrors()
                ],
                statusCode: 422
            );
        }

 
        $user = new User($this->db);

        try {
            $user->register(
                $formInput['username'],
                $formInput['email'],
                $formInput['password']
            );
            Session::flash('success', "✅ Dein Account wurde erfolgreich erstellt. Du kannst dich jetzt einloggen.");
            $this->response->redirectTo('/login');
        } catch (Exception $e) {
            $this->response->view('register/index', [
                'errors' => [
                    'root' => [$e->getMessage()]
                ]
            ]);
        }
    }
}

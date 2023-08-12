<?php


class LogoutController extends BaseController {
    public function index()
    {
        $this->user->logout();
        $this->response->redirectTo('/login');
    }
}
<?php

namespace controller;

use model\Authentication_model;

class Authentication
{
    protected $konfig;

    public function __construct($konfig)
    {
        $this->konfig = new Authentication_model($konfig);
    }

    public function Login()
    {
        session_start();
        if (isset($_POST['submit'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = md5($_POST['password'], false);
            $data = $this->konfig->LoginAuthentiction($email, $password);
            if ($data === true):
                return true;
            else:
                return false;
            endif;
        }
    }
}

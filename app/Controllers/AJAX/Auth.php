<?php

namespace App\Controllers\AJAX;
use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController
{
    public function index () {
        $session = session();
        $model = new ModelAuth();
        $dataJSON = $this->request->getJSON(true);
        $message = [];
        $login = '';

        if ($this->validator->run($dataJSON, 'login')) {
            # code...
            $where = array('username' => $dataJSON['username']);
            $dataLogin = $model->getUser($where);
            if ($dataLogin) {
                # code...
                if ($dataLogin['status'] == 1) {
                    # code...
                    if (password_verify($dataJSON['password'], $dataLogin['password'])) {
                        # code...
                        if ($dataLogin['role'] == 1) {
                            # code...
                            $login = 'admin';
                            // return redirect()->to(base_url('/dashboard'));
                        } else {
                            // return redirect()->to(base_url('/dashboard'));
                            $login = 'user';
                        }
                        $session->set($dataLogin);
                    } else {
                        $message[] = "Password Salah";
                    }
                } else {
                    $message[] = "User Tidak Aktif";
                }
            } else {
                $message[] = "User Tidak Terdaftar Pada Sistem";
            }
        } else {
            $message[] = implode(', ', $this->validator->getErrors());
        }

        $message = implode(', ', $message);
        $output = array('dataLogin' => $message, 'checkUser' => $login);
        echo json_encode($output);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        // checkAlreadyLogin();
        return redirect()->to(base_url('/login'));
    }
}

<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    public function index()
    {
        $muser = new ModelUser();
        $data = $muser->getUser(null);
        
        echo json_encode($data);
    }

    public function insertData(){
        $model = new ModelUser();
        $error[] = null;
        $message = null;
        $dataJSON = $this->request->getPost();
        $fileFoto = $this->request->getFile('file');
        $fileFoto = array('file' => $fileFoto);

        // var_dump($dataJSON); die;
        
        if ($dataJSON['username'] == 'undefined') { $dataJSON['username'] = null; }
        if ($dataJSON['password'] == 'undefined') { $dataJSON['password'] = null; }
        if ($dataJSON['repass'] == 'undefined') { $dataJSON['repass'] = null; }
        if ($dataJSON['role'] == 'undefined') { $dataJSON['role'] = null; }
        if ($dataJSON['status'] == 'undefined') { $dataJSON['status'] = null; }
        if ($dataJSON['nama'] == 'undefined') { $dataJSON['nama'] = null; }

        if ($this->validator->run($dataJSON, 'usertext') && $this->validator->run($fileFoto, 'userfoto')) {
            # code...
            $data = array (
                'username' => $dataJSON['username'],
                'password' => password_hash($dataJSON['password'], PASSWORD_DEFAULT),
                'role' => $dataJSON['role'],
                'status' => $dataJSON['status'],
                'nama' => $dataJSON['nama'],
                'foto' => $fileFoto['file']->getRandomName()
            );
            if ($fileFoto['file']->move("./foto", $data['foto'])) {
                # code...
                $model->insertData($data);
            } else {
                $error[] = "Gagal Menyimpan Foto";
            }
        } else {
            if ($this->validator->run($fileFoto, 'userfoto')) {
                # code...
                $error[] = implode(', ', $this->validator->getErrors());
            }
            $error[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode("", $error);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    // public function insertData(){
    //     $model = new ModelUser();
    //     $dataJSON = $this->request->getJSON(true);
    //     $errortext[] = '';
    //     $message = '';

    //     if ($this->validator->run($dataJSON, 'usertext')) {
    //         # code...
    //         $dataJSON = array(
    //             'username' => $dataJSON['username'],
    //             'password' => password_hash($dataJSON['password'], PASSWORD_DEFAULT),
    //             'role' => $dataJSON['role'],
    //             'status' => $dataJSON['status'],
    //             'nama' => $dataJSON['nama']
    //         );
    //         if ($model->insertData($dataJSON)) {
    //             # code...
    //             $message = "Berhasil Menyimpan Data";
    //         } else {
    //             $errortext[] = "Gagal Menyimpan Data";
    //         }
    //     } else {
    //         # code...
    //         $errortext[] = implode(', ', $this->validator->getErrors());
    //     }

    //     $validationtext = implode('', $errortext);
    //     $output = array('errortext' => $validationtext, 'message' => $message);

    //     echo json_encode($output);
    // }

    public function deleteData () {
        $model = new ModelUser();
        $where = $this->request->getJSON(true);
        
        $data = $model->getUser($where);
        $dataFoto =  $data[0]->foto;
        unlink("." . '/foto/'.$dataFoto);
        $data = $model->deleteData($where);
        return true;
    }

    public function getDetail ($where) {
        $model = new ModelUser();
        $where = array('id' => $where);
        $data = $model->getUser($where);

        echo json_encode($data);
    }

    public function updateData ($where) {
        $model = new ModelUser();
        $errortext[] = null;
        $message = null;
        $dataJSON = $this->request->getPost();
        $fileFoto = $this->request->getFile('file');
        $fileFoto = array('file' => $fileFoto);
        $fileFotoLama = $this->request->getPost('fileLama');
        $where = array('id' => $where);
        
        // jika tidak update password
        if ($dataJSON['password'] == 'undefined') {
            # code...
            $datatext = array(
                'username' => $dataJSON['username'],
                'role' => $dataJSON['role'],
                'status' => $dataJSON['status'],
                'nama' => $dataJSON['nama']
            );
            if ($this->validator->run($datatext, 'userEdit')) {
                # code...
                // jika mengubah foto
                if ($this->validator->run($fileFoto, 'userfoto')) {
                    # code...
                    $model->updateData($where, $datatext);
                    $dataFoto = array('foto' => $fileFoto['file']->getRandomName());
                    if ($fileFoto['file']->move("./foto", $dataFoto['foto'])) {
                        # code...
                        $model->updateData($where, $dataFoto);
                        if ($fileFotoLama != '/foto/') {
                            unlink("." . $fileFotoLama);
                        }
                    } else {
                        $errortext[] = "Gagal Menyimpan Foto";
                    }
                } else {
                    $message = "Berhasil Mengubah Data Tanpa Foto";
                    $model->updateData($where, $datatext);
                }
            } else {
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        } else {
            if ($dataJSON['repass'] == 'undefined') {
                # code...
                $datatext = array(
                    'username' => $dataJSON['username'],
                    'password' => $dataJSON['password'],
                    'repass' => null,
                    'role' => $dataJSON['role'],
                    'status' => $dataJSON['status'],
                    'nama' => $dataJSON['nama']
                );
            } else {
                $datatext = array(
                    'username' => $dataJSON['username'],
                    'password' => $dataJSON['password'],
                    'repass' => $dataJSON['repass'],
                    'role' => $dataJSON['role'],
                    'status' => $dataJSON['status'],
                    'nama' => $dataJSON['nama']
                );
            }

            if ($this->validator->run($datatext, 'usertext')) {
                # code...
                $datatext = array(
                    'username' => $dataJSON['username'],
                    'password' => password_hash($dataJSON['password'], PASSWORD_DEFAULT),
                    'role' => $dataJSON['role'],
                    'status' => $dataJSON['status'],
                    'nama' => $dataJSON['nama'],
                );
                // jika mengubah foto
                if ($this->validator->run($fileFoto, 'userfoto')) {
                    # code...
                    $model->updateData($where, $datatext);
                    $dataFoto = array('foto' => $fileFoto['file']->getRandomName());
                    if ($fileFoto['file']->move("./foto", $dataFoto['foto'])) {
                        # code...
                        $model->updateData($where, $dataFoto);
                        if ($fileFotoLama != '/foto/') {
                            unlink("." . $fileFotoLama);
                        }
                    } else {
                        $errortext[] = "Gagal Menyimpan Foto";
                    }
                } else {
                    $message = "Berhasil Mengubah Data";
                    $model->updateData($where, $datatext);
                }
            } else {
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        }
        $validationtext = implode("", $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    // public function updateData ($where) {
    //     $errortext[] = null;
    //     $message = null;
    //     $model = new ModelUser();
    //     $where = array('id' => $where);
    //     $dataJSON = $this->request->getJSON(true);

    //     // echo json_encode($dataJSON); die;
    //     // jika tidak update password
    //     if ($dataJSON['password'] == '' || $dataJSON['password'] == null || $dataJSON['password'] == 'undefined') {
    //         # code...
    //         $datatext = array(
    //             'username' => $dataJSON['username'],
    //             'role' => $dataJSON['role'],
    //             'status' => $dataJSON['status'],
    //             'nama' => $dataJSON['nama'],
    //         );
    //         if ($this->validator->run($datatext, 'userEdit')) {
    //             # code...
    //             if ($model->updateData($where, $datatext)) {
    //                 # code...
    //                 $message = "Berhasil Mengubah Data";
    //             } else {
    //                 # code...
    //                 $errortext[] = "Gagal Menyimpan Data";
    //             }
    //         } else {
    //             $errortext[] = implode(', ', $this->validator->getErrors());
    //         }
    //     } else {
    //         # code...
    //         if ($this->validator->run($dataJSON, 'usertext')) {
    //             # code...
    //             $datatext = array(
    //                 'username' => $dataJSON['username'],
    //                 'role' => $dataJSON['role'],
    //                 'status' => $dataJSON['status'],
    //                 'nama' => $dataJSON['nama'],
    //             );
    //             if ($model->updateData($where, $datatext)) {
    //                 # code...
    //                 $message = "Berhasil Mengubah Data";
    //             } else {
    //                 # code...
    //                 $errortext[] = "Gagal Menyimpan Data";
    //             }
    //         } else {
    //             $errortext[] = implode(', ', $this->validator->getErrors());
    //         }
    //     }
    //     $validationtext = implode("", $errortext);
    //     $output = array('errortext' => $validationtext, 'message' => $message);
    //     echo json_encode($output);
    // }
}

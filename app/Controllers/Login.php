<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

use function PHPSTORM_META\type;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $mensaje = 'Email o contraseña inválidos';

        $validation = service('validation');
        $validation->setRules(
            [
                'email' => 'required|valid_email',
                'password' => 'required',
            ],
            [
                'email' => [
                    'required' => 'El campo email es obligatorio',
                    'valid_email' => 'Email invalido'
                ],
                'password' => [
                    'required' => 'El campo contraseña es obligatorio',
                ]
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password').'';
        
        $user = new UserModel();
        $dataUser = $user->where('email', $email)->find();

        if (count($dataUser) > 0 && password_verify($password, $dataUser[0]['password'])) {

            $data = [
                'id' => $dataUser[0]['id'],
                'nombre' => $dataUser[0]['nombre'],
                'email' => $dataUser[0]['email'],
                'is_logged' => true,
            ];

            $session = session();
            $session->set($data);

            return redirect()->to(base_url('/home/tareas'));
        } else {
            session()->setFlashData("error_controller", "Email o contraseña incorrectos");
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Registro extends BaseController
{
    public function index()
    {
        return view('registro.php');
    }

    public function registrarUsuario()
    {
        $validation = service('validation');
        $validation->setRules(
            [
                'nombre' => 'required|min_length[3]|max_length[12]|alpha_space',
                'apellido' => 'required|min_length[3]|max_length[12]|alpha_space',
                'password' => 'required|min_length[8]|matches[c-password]',
                'email' => 'required|valid_email|is_unique[usuario.email]',
            ],
            [
                'nombre' => [
                    'required' => 'El campo nombre es obligatorio',
                    'min_length' => 'La longitud minima es 3',
                    'max_length' => 'La longitud maxima es 12',
                    'alpha_space' => 'Solo puede ser caracteres alfabéticos y el espacio'
                ],
                'apellido' => [
                    'required' => 'El campo apellido es obligatorio',
                    'min_length' => 'La longitud minima es 3',
                    'max_length' => 'La longitud maxima es 12',
                    'alpha_space' => 'Solo puede ser caracteres alfabéticos y el espacio'
                ],
                'password' => [
                    'required' => 'El campo contraseña es obligatorio',
                    'min_length' => 'La longitud minima es 8',
                    'matches' => 'Las contraseñas no coinciden'
                ],
                'email' => [
                    'required' => 'El campo email es obligatorio',
                    'is_unique' => 'El email ya se encuentra en uso',
                    'valid_email' => 'Email invalido'
                ]
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $password = $this->request->getPost('password') . '';
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'email' => $this->request->getPost('email'),
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'password' => $passwordHash,
        ];

        $user = new UserModel();
        if ($user->insert($data)) {
            return view('login');
        } else {
            echo 'error';
        }
    }
}

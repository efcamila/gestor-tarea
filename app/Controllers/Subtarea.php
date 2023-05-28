<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TareaModel;
use App\Models\SubTareaModel;
use App\Models\ColaboradorModel;

class Subtarea extends BaseController
{

    public function nueva_subtarea($id = null)
    {
        $data['id'] = $id;
        $data['cabecera'] = view('home/template/cabecera');

        $tarea = new TareaModel();
        $tarea->select('idCreador');
        $tarea = $tarea->where('id', $id)->first();

        if ($tarea) {
            if ($tarea['idCreador'] == session('id')) {
                return view('/home/subtareas/nuevasubtarea', $data);
            } else {
                return redirect()->to(base_url('home/tareas'));
            }
        }
    }

    public function validar_subtarea($id = null)
    {
        $fecha_actual = date("Y-m-d");
        $estado = '1';

        $validation = service('validation');
        $validation->setRules(
            [
                'descripcion' => 'required',
                'responsable' => 'required|valid_email|is_not_unique[usuario.email]'
            ],
            [
                'descripcion' => [
                    'required' => 'El campo descripción es obligatorio',
                ],
                'responsable' => [
                    'required' => 'El campo email es obligatorio',
                    'valid_email' => 'El email ingresado debe ser válido',
                    'is_not_unique' => 'El email ingresado no se encuentra registrado',
                ]
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('responsable');
        $user = new UserModel();
        $user->select('id');
        $id_user = $user->select('id')->where('email', $email)->first();

        $data = [
            'idTarea' => $id,
            'descripcion' => $this->request->getPost('descripcion'),
            'idResponsable' => $id_user['id'],
            'fechaCreacion' => $fecha_actual,
            'fechaVencimiento' => $this->request->getPost('fecha_vencimiento'),
            'comentario' => $this->request->getPost('comentario'),
            'estado' => $estado,
            'prioridad' => $this->request->getPost('prioridad'),
        ];

        $data_c = [
            'idTarea' => $id,
            'idUsuario' => $id_user['id']
        ];

        $subtarea = new SubTareaModel();
        $colaborador = new ColaboradorModel();

        $where = 'idUsuario=' . $id_user['id'] . ' and idTarea=' . $id;
        if ($colaborador->where($where)->find()) {
            $subtarea->insert($data);
            return redirect()->to(base_url('/home/tareas'));
        } else {
            if ($subtarea->insert($data) && $colaborador->insert($data_c)) {
                return redirect()->to(base_url('/home/tareas'));
            } else {
                echo 'error';
            }
        }
    }

    public function eliminar_subtarea($id = null)
    {
        $tarea = new SubTareaModel();
        $tarea->where('id', $id)->delete($id);
        return redirect()->to(base_url('/home/tareas'));
    }


    public function editar_subtarea($id = null)
    {
        $subtarea = new SubTareaModel();
        $where = 's.id=' . $id;
        $data['subtarea'] = $subtarea->get_subtareas($where);
        $data['cabecera'] = view('home/template/cabecera');

        if (empty($data['subtarea'])) {
            return redirect()->to(base_url('home/tareas'));
        } else {
            if ($data['subtarea'][0]['idCreador'] == session('id') || $data['subtarea'][0]['idResponsable'] == session('id')) {
                return view('/home/subtareas/editarsubtarea', $data);
            } else {
                return redirect()->to(base_url('home/tareas'));
            }
        }
    }


    public function actualizar_subtarea($id = null)
    {
        $validation = service('validation');
        $validation->setRules(
            [
                'descripcion' => 'required',
                'responsable' => 'required|valid_email|is_not_unique[usuario.email]',
                'estado' => 'required',
            ],
            [
                'descripcion' => [
                    'required' => 'El campo descripción es obligatorio',
                ],
                'responsable' => [
                    'required' => 'El campo responsable es obligatorio',
                    'valid_email' => 'El email ingresado debe ser válido',
                    'is_not_unique' => 'El email ingresado no se encuentra registrado',
                ],
                'estado' => [
                    'required' => 'El campo estado es obligatorio',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('responsable');
        $user = new UserModel();
        $id_user = $user->where('email', $email)->first();

        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'responsable' => $id_user['id'],
            'estado' => $this->request->getPost('estado'),
            'prioridad' => $this->request->getPost('prioridad'),
            'fechaVencimiento' => $this->request->getPost('fecha_vencimiento'),
            'comentario' => $this->request->getPost('comentario')
        ];


        $data_estado_proceso = [
            'estado' => '2',
        ];

        $data_estado_finalizada = [
            'estado' => '3',
        ];

        $tareaModel = new TareaModel();
        $tarea_sql = $tareaModel->get_tareas_subtareas($id);
        $tarea = $tarea_sql[0];

        if ($data['estado'] == 3 && $tarea['estado'] == 1) {
            $tareaModel->update($tarea['id'], $data_estado_proceso);
        }

        $subtarea = new SubTareaModel();
        if ($subtarea->update($id, $data)) {
            $this->updateSubtarea($tarea['id'], $data_estado_finalizada);
            return redirect()->to(base_url('/home/tareas'));
        }
    }

    public function actualizar_subtarea_estado($id = null)
    {
        $validation = service('validation');
        $validation->setRules(
            ['estado' => 'required',],
            ['estado' => [
                    'required' => 'El campo estado es obligatorio',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'estado' => $this->request->getPost('estado'),
            'comentario' => $this->request->getPost('comentario')
        ];


        $data_estado_proceso = [
            'estado' => '2',
        ];

        $data_estado_finalizada = [
            'estado' => '3',
        ];

        $tareaModel = new TareaModel();
        $tarea_sql = $tareaModel->get_tareas_subtareas($id);
        $tarea = $tarea_sql[0];

        if ($data['estado'] == 3 && $tarea['estado'] == 1) {
            $tareaModel->update($tarea['id'], $data_estado_proceso);
        }

        $subtarea = new SubTareaModel();
        if ($subtarea->update($id, $data)) {
            $this->updateSubtarea($tarea['id'], $data_estado_finalizada);
            return redirect()->to(base_url('/home/tareas'));
        }
    }

    public function updateSubtarea($id_tarea, $data_estado_finalizada)
    {
        $subtarea = new SubTareaModel();
        $tarea = new TareaModel();

        $total_subtarea = $subtarea->select('COUNT(estado)')->where('idTarea', $id_tarea)->first();
        $total_subtarea_finalizada = $subtarea->select('COUNT(estado)')
            ->where('idTarea', $id_tarea)
            ->where('estado', 3)
            ->first();
        if ($total_subtarea['COUNT(estado)'] - $total_subtarea_finalizada['COUNT(estado)'] == 0) {
            $tarea->update($id_tarea, $data_estado_finalizada);
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TareaModel;
use App\Models\SubTareaModel;

class Tarea extends BaseController
{
    public function nueva_tarea()
    {
        $data['cabecera'] = view('home/template/cabecera');
        return view('/home/tareas/nuevatarea', $data);
    }

    public function validar_tarea()
    {
        $fecha_actual = date("Y-m-d");
        $estado = '1';

        $validation = service('validation');
        $validation->setRules(
            [
                'asunto' => 'required',
                'descripcionTarea' => 'required',
                'prioridad' => 'required',
                'fecha_vencimiento' => 'required',
            ],
            [
                'asunto' => [
                    'required' => 'El campo asunto es obligatorio',
                ],
                'descripcionTarea' => [
                    'required' => 'El campo descripción es obligatorio',
                ],
                'prioridad' => [
                    'required' => 'El campo prioridad es obligatorio',
                ],
                'fecha_vencimiento' => [
                    'required' => 'El campo fecha de vencimiento es obligatorio',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors_tarea', $validation->getErrors());
        }

        $data = [
            'idCreador' => session('id'),
            'asunto' => $this->request->getPost('asunto'),
            'descripcion' => $this->request->getPost('descripcionTarea'),
            'prioridad' => $this->request->getPost('prioridad'),
            'estado' => $estado,
            'fechaCreacion' => $fecha_actual,
            'fechaVencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fechaRecordatorio' => $this->request->getPost('fecha_recordatorio'),
            'color' => $this->request->getPost('color')
        ];

        $tarea = new TareaModel();

        if ($tarea->insert($data)) {
            return redirect()->to(base_url('/home/tareas'));
        }
    }

    public function eliminar_tarea($id = null)
    {
        $tarea = new TareaModel();
        $tarea->where('id', $id)->delete($id);
        return redirect()->to(base_url('/home/tareas'));
    }

    public function editar_tarea($id = null)
    {
        $tarea = new TareaModel();
        $data['tarea'] = $tarea->where('id', $id)->first();
        $data['cabecera'] = view('home/template/cabecera');

        if (empty($data['tarea']) || $data['tarea']['idCreador'] != session('id')) {
            return redirect()->to(base_url('home/tareas'));
        } else {
            return view('/home/tareas/editartarea', $data);
        }
    }

    public function actualizar_tarea($id = null)
    {

        $validation = service('validation');
        $validation->setRules(
            [
                'asunto' => 'required',
                'descripcion' => 'required',
                'prioridad' => 'required',
                'fecha_vencimiento' => 'required',
            ],
            [
                'asunto' => [
                    'required' => 'El campo asunto es obligatorio',
                ],
                'descripcion' => [
                    'required' => 'El campo descripción es obligatorio',
                ],
                'prioridad' => [
                    'required' => 'El campo prioridad es obligatorio',
                ],
                'fecha_vencimiento' => [
                    'required' => 'El campo fecha de vencimiento es obligatorio',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors_tarea', $validation->getErrors());
        }

        $data = [
            'asunto' => $this->request->getPost('asunto'),
            'descripcion' => $this->request->getPost('descripcion'),
            'prioridad' => $this->request->getPost('prioridad'),
            'fechaVencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fechaRecordatorio' => $this->request->getPost('fecha_recordatorio'),
            'color' => $this->request->getPost('color')
        ];

        $tarea = new TareaModel();
        if ($tarea->update($id, $data)) {
            return redirect()->to(base_url('/home/tareas'));
        }
    }

    public function ver_tarea($id = null)
    {
        $data['cabecera'] = view('home/template/cabecera');

        $tarea = new TareaModel();
        $data['tarea'] = $tarea->get_tarea($id);

        $subtarea = new SubtareaModel();
        $data['subtareas'] = $subtarea->get_subtareas_idtarea($id);
        
        return view('/home/tarea', $data);
    }
}

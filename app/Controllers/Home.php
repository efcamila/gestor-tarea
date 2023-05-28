<?php

namespace App\Controllers;

use App\Models\ColaboradorModel;
use App\Models\TareaModel;
use App\Models\SubTareaModel;

class Home extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        if (session('is_logged') != true) {
            return redirect()->to(base_url('/login'));
        }
    }


    public function index()
    {
        if (isset($_GET['orden'])) {
            $orden = $this->request->getGet('orden');
        } else {
            $orden = 'recientes';
        }

        $data['tareas'] = $this->ordenar(session('id'), $orden);
        $data['orden'] = $orden;

        $subtarea = new SubTareaModel();
        $where='t.idCreador='.session('id').' or c.idUsuario='.session('id');
        $data['subtareas'] = $subtarea->get_subtareas($where);

        $data['cabecera'] = view('home/template/cabecera');
        
        return view('/home/tareas', $data);
    }

    public function subtarea()
    {
        return view('home/subtareas');
    }

    public function archivado()
    {
        $tarea = new TareaModel();
        $data['cabecera'] = view('home/template/cabecera');
        $data['tareas'] = $tarea->where('idCreador', session('id'))->where('estado', '4')->findAll();
        
        $subtarea = new SubTareaModel();
        $where='t.idCreador='.session('id').' or c.idUsuario='.session('id');
        $data['subtareas'] = $subtarea->get_subtareas($where);

        return view('home/archivado', $data);
    }

    public function archivar($id = null)
    {
        $tarea = new TareaModel();
        $tarea_result = $tarea->find($id);

        $data['estado']=4;

        if ($tarea_result['idCreador'] == session('id')) {
            if ($tarea->update($id, $data)) {
                return redirect()->to(base_url('/home/tareas')); 
            }else{
                echo 'error';
            }
        } else {
            return redirect()->to(base_url('/home/tareas'));
        }
    }


    public function ordenar($id, $orden)
    {
        $tarea = new TareaModel();
        switch ($orden) {
            case 'recientes':
                $tareas = $tarea->get_tareas_por_orden($id, '1');
                break;
            case 'primeras':
                $tareas = $tarea->get_tareas_por_orden($id, '2');
                break;
            case 'vencimiento':
                $tareas = $tarea->get_tareas_por_orden($id, '3');
                break;
            case 'prioridad':
                $tareas = $tarea->get_tareas_por_orden($id, '4');
                break;
            default:
                $tareas = $tarea->get_tareas_por_orden($id, '1');
                break;
        }
        return $tareas;
    }
}

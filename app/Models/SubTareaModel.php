<?php

namespace App\Models;
use CodeIgniter\Model;

class SubTareaModel extends Model
{
    protected $table = 'subtarea';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'idTarea', 'idResponsable',
        'descripcion', 'prioridad', 'estado', 'fechaCreacion', 'fechaVencimiento',
        'comentario'
    ];

    public function get_subtareas($where)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('subtarea s');
        $builder->select('s.*,u.nombre,u.apellido,u.email,t.idCreador,e.descripcion as d_estado, p.descripcion as d_prioridad');
        $builder->join('tarea t', 't.id=s.idTarea','left');
        $builder->join('colaboradores c', 's.idTarea=c.idTarea and c.idUsuario='.session('id'),'left');
        $builder->join('usuario u', "u.id=s.idResponsable",'left');
        $builder->join('estado e', "e.id=s.estado",'left');
        $builder->join('prioridad p', "p.id=s.prioridad",'left');
        $builder->where($where);
        $data = $builder->get()->getResultArray();
        return $data;
    }

    public function get_subtareas_idtarea($id){
        $db      = \Config\Database::connect();
        $builder = $db->table('subtarea s');
        $builder->select('s.*,u.nombre,u.apellido,u.email,t.idCreador,e.descripcion as d_estado, p.descripcion as d_prioridad');
        $builder->join('tarea t', 't.id=s.idTarea','left');
        $builder->join('colaboradores c', 't.id=c.idTarea and c.idUsuario='.session('id'),'left');
        $builder->join('usuario u', "u.id=s.idResponsable",'left');
        $builder->join('estado e', "e.id=s.estado",'left');
        $builder->join('prioridad p', "p.id=s.prioridad",'left');
        $where='t.id='.$id;
        $builder->orderBy('s.id','ASC');
        $builder->where($where);
        $data = $builder->get()->getResultArray();
        return $data;
    }
}

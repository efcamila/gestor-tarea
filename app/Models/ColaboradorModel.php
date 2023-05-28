<?php

namespace App\Models;
use CodeIgniter\Model;

class ColaboradorModel extends Model
{
    protected $table = 'colaboradores';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'idTarea', 'idUsuario',
    ];

    public function get_tareas_colaborador($id){

        $db      = \Config\Database::connect();
        $builder = $db->table('colaboradores c');
        $builder->select('t.*,c.idTarea, c.idUsuario');
        $builder->join('tarea t', "t.id=c.idTarea");
        $where = 'c.idUsuario='.$id.' and estado<=3';
        $builder->where($where);
        $data = $builder->get()->getResultArray();
        return $data;
    }
}
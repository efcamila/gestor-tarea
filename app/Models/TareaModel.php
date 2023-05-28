<?php 

namespace App\Models;
use CodeIgniter\Model;

class TareaModel extends Model{
    protected $table = 'tarea';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idCreador','asunto',
    'descripcion','prioridad','estado','fechaCreacion','fechaVencimiento',
    'fechaRecordatorio','color'];

    public function get_tareas_por_orden($id,$orden){

        $db      = \Config\Database::connect();
        $builder = $db->table('tarea t');
        $builder->select('t.*,c.idTarea, c.idUsuario');
        $builder->join('colaboradores c', "t.id=c.idTarea and c.idUsuario=".session('id'),'left');
        $where = 'estado<=3 and (idCreador='.$id.' or idUsuario='.$id.')';
        $builder->where($where);
        //var_dump($orden);
        switch ($orden){
            case 1:
                $builder->orderBy('t.id','DESC');
                break;
            case 2:
                $builder->orderBy('t.id','ASC');
                break;
            case 3: 
                $builder->orderBy('fechaVencimiento','ASC');
                break;
            case 4:
                $builder->orderBy('prioridad','DESC');
                break;
            default:
                $builder->orderBy('id','ASC');
                break;
        }
        
        $data = $builder->get()->getResultArray();
        return $data;
    }


    public function get_tarea($id){
        $db      = \Config\Database::connect();
        $builder = $db->table('tarea t');
        $builder->select('t.*,u.nombre,u.apellido,u.email,e.descripcion as e_d,p.descripcion as p_d');
        $builder->join('usuario u', "u.id=t.idCreador");
        $builder->join('estado e', "e.id=t.estado");
        $builder->join('prioridad p', "p.id=t.prioridad");
        $where = 't.id='.$id;
        $builder->where($where);
        $data = $builder->get()->getResultArray();
        return $data;
    }


    public function get_tareas_subtareas($id){
        $db      = \Config\Database::connect();
        $builder = $db->table('tarea t');
        $builder->select('t.id,t.estado');
        $builder->join('subtarea s', "t.id=s.idTarea",'left');
        $where = 's.id='.$id;
        $builder->where($where);
        $data = $builder->get()->getResultArray();
        return $data;
    }

}

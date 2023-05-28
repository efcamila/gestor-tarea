<?php 

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email','nombre','apellido','password'];

    public function get_usuario_email($email){
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('id');
        $builder->where('email', $email);
        $id_user = $builder->get()->getResultArray();
    }

}

?>
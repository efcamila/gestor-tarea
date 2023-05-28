<?php 
namespace App\Models\Validation\Email;

use App\Models\UserModel;

class Email {
    public function matches_email (string $email): bool 
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('email');
        $builder->where('email',$email);
        return $builder == null ? false : true;
    }
}

?>
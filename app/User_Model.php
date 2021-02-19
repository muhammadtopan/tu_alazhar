<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;

class User_Model extends Model
{
    use SoftDeletes;
    protected $table = "tb_user";
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'username', 'password', 'id_s', 'level',
    ];

    public static function GetValidationRule($rule_name)
    {
        return self::$validation_rule[$rule_name];
    }

    public function CheckLoginAdmin($username, $password)
    {
        $data_user = $this->where("username", $username)->get();
        // dd(count($data_user) == 1);
        if (count($data_user) == 1) {
            // dd($data_user->all());
            // if (Hash::check($password, $data_user[0]->password)) {
            //     unset($data_user[0]->password);
            //     $data_user[0]->level = "4";
            // }
            return $data_user[0];
        }
        return false;
    }
}

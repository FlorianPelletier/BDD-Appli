<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

class character extends Model
{
    //nom de la table dans la BD
    protected $table = "character";
    //clé primaire dans la BD
    protected $primaryKey = "id";

    //association des clés étrangères
    public function asso(){
        return $this->hasMany('src\models\character', '');
    }
}
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
    public function jeux(){
        return $this->belongsToMany('src\models\Game', 'game2character','character_id', 'game_id');
    }
}
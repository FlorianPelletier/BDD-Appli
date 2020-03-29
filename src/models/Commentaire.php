<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    //nom de la table dans la BD
    protected $table = "commentaire";
    //clé primaire dans la BD
    protected $primaryKey = "comment_id";


    //pour model game
    public function jeux(){
        return $this->belongsToMany('src\models\Commentaire', 'commentaire2game','game_id', 'comment_id');
    }
    public function users(){
        return $this->belongsToMany('src\models\Commentaire', 'utilisateur2commentaire', 'game_id', 'email');
    }
}




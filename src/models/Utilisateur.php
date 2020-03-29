<?php
namespace src\models;


use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    //nom de la table dans la BD
    protected $table = "utilisateur";
    //clé primaire dans la BD
    protected $primaryKey = "email";

    //association des clés étrangères
    public function commentaire(){
        return $this->belongsToMany('src\models\Utilisateur', 'utilisateur2commentaire','email', 'comment_id');
    }
}
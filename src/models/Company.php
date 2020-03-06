<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table = "company";
    protected $primaryKey = "id";

    public function games(){
        return $this->belongsToMany('src\models\Game', 'game_developers', 'comp_id', 'game_id');
    }
}
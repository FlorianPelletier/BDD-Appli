<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

class game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'id';

    public function appears_in(){
        return $this->belongsToMany('Model\character', 'game2character','game_id', 'character_id');
    }
}
<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

class game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'id';

    public function personnages(){
        return $this->belongsToMany('src\models\Character', 'game2character','game_id', 'character_id');
    }
}
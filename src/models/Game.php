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

    public function company(){
        return $this->belongsToMany('src\models\Company', 'game_developers', 'comp_id', 'game_id');
    }

    public function ratings(){
        return $this->belongsToMany('src\models\Game_Rating', 'game2rating', 'rating_id', 'game_id');
    }

}
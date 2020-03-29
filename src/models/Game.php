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

    public function publishers(){
        return $this->belongsToMany('src\models\Company', 'game_publishers', 'game_id', 'comp_id');
    }
    public function developers(){
        return $this->belongsToMany('src\models\Company', 'game_developers', 'game_id', 'comp_id');
    }


    public function ratings(){
        return $this->belongsToMany('src\models\Game_Rating', 'game2rating', 'game_id', 'rating_id');
    }

    public function commentaire(){
        return $this->belongsToMany('src\models\Commentaire', 'commentaire2game', 'game_id', 'comment_id');
    }

}
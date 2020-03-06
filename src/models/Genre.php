<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'genre';

    public function jeux(){
        return $this->belongsToMany('src\models\Game', 'game2genre', 'genre_id', 'game_id');
    }
}
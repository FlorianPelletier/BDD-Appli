<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

class Game_Rating extends Model
{
    protected $table = 'game_rating';
    protected $primaryKey = 'id';

    public function rating_board(){
        return $this->belongsTo('src\models\Rating_Board', 'rating_board_id');
    }
}
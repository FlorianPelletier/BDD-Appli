<?php


namespace src\controleurs;


use src\models\character;
use src\models\company;
use src\models\game;
use src\models\platform;

class controleurquestion
{

    public function q1(){
        $games = game::where('name', 'like', '%Mario%')->get();
        foreach ($games as $game){
            echo $game->name . "<br>";
        }
    }

    public function q2(){
        $compagnies = company::where('location_country','like', 'Japan')->get();
        foreach ($compagnies as $compagny){
            echo $compagny->name . "<br>";
        }
    }

    public function q3(){
        $platforms = platform::where('install_base', '>=', 10000000)->get();
        foreach ($platforms as $platform){
            echo ($platform->name . "<br>");
        }
    }

    public function q4(){
        $games = game::skip(21173)->take(442)->get();
        foreach ($games as $game){
            echo $game->name;
        }
    }

    public function q5(){
        $nb = game::count();
        echo "il y a : " . $nb . " jeux";


        $games = game::skip(0)->take(500)->get();
        echo "<ul>";
        foreach ($games as $game){
            echo "<li>".$game->name . " " . $game->deck . "</li>>";
        }
        echo "</ul>";

    }



}
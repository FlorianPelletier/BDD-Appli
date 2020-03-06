<?php


namespace src\controleurs;


use src\models\character;
use src\models\company;
use src\models\game;
use src\models\Genre;
use src\models\platform;
use src\models\Rating_Board;
use src\models\Game_Rating;

class controleurquestion
{
    //-------------------------------------------------------------------------------------------------------------
    //Séance 1
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

    //-------------------------------------------------------------------------------------------------------------
    //Séance 2
    //afficher (name , deck) les personnages du jeu 12342
    public function question21(){
        $jeu = Game::find('12342');
        $personnage = $jeu->personnages()->get();
        $res = "";
        foreach ($personnage as $value){
            $res .= "nom : " . $value->name. "  /deck : ".$value->deck . "</br>";
        }
        echo $res;
    }

    //les personnages des jeux dont le nom (du jeu) débute par 'Mario'
    public function question22(){
        $jeux = Game::where('name', 'like', "Mario%")->get();
        $res = '';
        foreach ($jeux as $val){
            $personnages = $val->personnages()->get();
            foreach ($personnages as $value){
                $res .= 'nom : ' . $value->name. '</br>';
            }
            echo $res;
        }

    }

    //les jeux développés par une compagnie dont le nom contient 'Sony'
    public function question23(){
        $compagnies = Company::where('name', 'like', '%Sony%')->get();
        $res = '';
        foreach ($compagnies as $val){
            $jeux = $val->games()->get();

            foreach($jeux as $value){
                $res .= 'nom : ' .$value->name. '</br>';
            }
            echo $res;
        }
    }

    //les jeux dont le nom débute par Mario et ayant plus de 3 personnages
    public function question25(){
        $games = Game::where('name','like','Mario%')->has('personnages', '>', '3')->get();
        $res = '';
        foreach($games as $value){
            $res .= 'nom : ' .$value->name. '</br>';
        }
        echo $res;
    }
   

    //les jeux dont le nom débute par Mario, publiés par une compagnie dont le nom contient
    //"Inc." et dont le rating initial contient "3+"
    public function question27(){
        $jeux = Game::where('name', 'like', 'Mario%')
            ->whereHas('publishers', function($q){
                $q->where('name', 'like', '%Inc.%');
            })->whereHas('ratings', function($q){
                $q->where('name', 'like', '%3+%');
            })->get();


        foreach ($jeux as $values){
            echo "Nom du jeu : ".$values->name."</br>";
        }
    }

    //les jeux dont le nom débute Mario, publiés par une compagnie dont le nom contient "Inc",
    //dont le rating initial contient "3+" et ayant reçu un avis de la part du rating board nommé
    //"CERO"
    //TODO FIX
    public function question28(){
        $jeux = Game::where('name', 'like', 'Mario%')
            ->whereHas('publishers', function ($q){
                $q->where('name', 'like', '%Inc%');
            })->whereHas('ratings', function($q){
                $q->where('name', 'like', '%3+%');
            })->whereHas('rating_board', function($q){
                $q->where('name', 'like', 'CERO');
            })->get();

        foreach ($jeux as $values){
            echo "Nom du jeu : ".$values->name."</br>";
        }
    }

    //ajouter un nouveau genre de jeu, et l'associer aux jeux 12, 56, 12, 345
    public function question29(){
        $nouveauGenre = new Genre();
        $nouveauGenre->id = 51;
        $nouveauGenre->name = 'newGenre';
        $nouveauGenre->deck = 'un super nouveau genre';
        $nouveauGenre->description = 'nouveau genre';
        $nouveauGenre->save();

        $nouveauGenre->jeux()->attach([12, 56, 21, 345]);

        //tests
        $genre = Genre::find(51);
        echo $genre->name;

        $jeux = Game::find([12, 56, 21, 345])->get();
        foreach ($jeux as $val){
            echo $val->genre;
        }
    }



}
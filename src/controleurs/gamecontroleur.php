<?php


namespace src\controleurs;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Slim;
use src\models\game;

class gamecontroleur
{

    public function getGame($id)
    {
        $app = Slim::getInstance();

        try {
            $game = Game::select('id', 'name', 'alias', 'deck', 'description', 'original_release_date')
                ->where('id', 'like', $id)
                ->firstOrFail();

        }catch (ModelNotFoundException $e){
            $app->response->setStatus(404);
            $app->response->headers->set('Content-Type', 'application/json');
            return;
        }

        $links = array(
            "comments"=>array("href"=>"/api/games/".$id."/comments"),
            "characters"=>array("href"=>"/api/games/".$id."/characters")
        );

        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $response = array("game"=>$game,"links"=>$links);
        echo json_encode($response);
    }

    public function getGames()
    {
        $app = Slim::getInstance();

        $page = $app->request->get('page');

        $games = Game::skip($page*200)->take($page*200+200)->select('id', 'name', 'alias', 'deck')->get();
        $jeux = [];
        $compteur = 0;
        foreach ($games as $val){
            $gamelink = array("links"=>array("self"=>array("href"=>"/api/games/".$val->id)));
            $jeux[$compteur] = array("game"=>$val, "links"=>$gamelink);
            $compteur++;
        }


        if($page == 0){
            $paginationPrecedente = "/api/games?page=".($page);
        } else if ($page<0){
            $paginationPrecedente = "/api/games?page=0";
        }else{
            $paginationPrecedente = "/api/games?page=".($page-1);
        }
        $paginationSuivante = "/api/games?page=".($page+1);

        $links = array("prev"=>array("href"=>$paginationPrecedente), "next"=>array("href"=>$paginationSuivante));

        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $result = array("games"=>$jeux, "links"=>$links);
        echo json_encode($result);
    }

    public function getComments($gameid)
    {
        //l'id, le titre, le texte,
        //la date de création et le nom de l'utilisateur.
        $commentaires = "".$gameid;
        $commentaires = array("commentaires"=>$commentaires);
        echo json_encode($commentaires);
    }

    public function getCharacters($gameid)
    {
        $app = Slim::getInstance();
        $jeu = Game::where("id", "like", $gameid)->get();

        $resultat = [];
        $compteur = 0;
        foreach ($jeu as $g) {
            $perso = $g->personnages()->get();
            foreach ($perso as $value) {

                $links = array("self" => array("href" => "/api/characters/" . $value->id));
                $personnages = array("id" => $value->id, "name" => $value->name);
                $current = array("character" => $personnages, "links" => $links);

                $resultat[$compteur] =  $current;
                $compteur++;
            }
        }
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $resultat = array("characters"=>$resultat);
        echo json_encode($resultat);
    }


}
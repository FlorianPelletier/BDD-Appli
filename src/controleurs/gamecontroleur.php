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

        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        echo json_encode($game);
    }

    public function getGames()
    {
        $app = Slim::getInstance();

        $page = $app->request->get('page');

        $games = Game::skip($page*200)->take($page*200+200)->select('id', 'name', 'alias', 'deck')->get();

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
        $games = array("games"=>$games, "links"=>$links);
        echo json_encode($games);
    }

    public function getComments($gameid)
    {
        //l'id, le titre, le texte,
        //la date de création et le nom de l'utilisateur.
        $commentaires = "";


        $commentaires = array("commentaires"=>$commentaires);
        echo json_encode($commentaires);

    }


}
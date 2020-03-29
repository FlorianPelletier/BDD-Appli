<?php


namespace src\controleurs;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\Util;
use Slim\Slim;
use src\models\Commentaire;
use src\models\game;
use src\models\Utilisateur;

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
            "comments"=>array("href"=>$app->urlFor("comments", ["gameid"=>$id])),
            "characters"=>array("href"=>$app->urlFor("characters", ["gameid"=>$id]))
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
        $g = Game::select('id')->get();
        $pagemax = count($g);
        $pagemax = round($pagemax/200)-1;
        $games = Game::skip($page*200)->take(200)->select('id', 'name', 'alias', 'deck')->get();
        $jeux = [];
        $compteur = 0;
        foreach ($games as $val){
            $gamelink = array("links"=>array("self"=>array("href"=>$app->urlFor("game", ["id"=>$val->id]))));
            $jeux[$compteur] = array("game"=>$val, "links"=>$gamelink);
            $compteur++;
        }

        if ($page <= 0){
            $paginationPrecedente = $app->urlFor("games")."?page=0";
        }else{
            $paginationPrecedente = $app->urlFor("games")."?page=".($page-1);
        }
        if($page >= $pagemax){
            $paginationSuivante = $app->urlFor("games")."?page=".($pagemax);
        }else{
            $paginationSuivante = $app->urlFor("games")."?page=".($page+1);
        }

        $links = array("prev"=>array("href"=>$paginationPrecedente), "next"=>array("href"=>$paginationSuivante));

        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $result = array("games"=>$jeux, "links"=>$links);
        echo json_encode($result);
    }

    public function getComments($gameid)
    {
        //Pour chaque commentaire retourné dans la collection, la représentation contient l'id, le titre, le texte,
        //la date de création et le nom de l'utilisateur.
        $app = Slim::getInstance();

        $jeux = Game::where('id', 'like', $gameid)->get();
        $res = [];
        $compteur = 0;
        foreach ($jeux as $val){
            $commentaire = $val->commentaire()->get();
            $res[$compteur] = $commentaire;
            $compteur ++;
        }

        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        echo json_encode(array("Comments"=>$res));
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

                $links = array("self" => array("href" => $app->urlFor("characters", ["gameid"=>$value->id])));
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
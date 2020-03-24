
<?php
session_start();

use src\models\game;
use src\vue\VueAccueil;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Slim;
use src\controleurs\controleurquestion;

require_once 'vendor/autoload.php';

$app = new Slim();

$app->get('/api/games/:id', function ($id) {
    (new \src\controleurs\gamecontroleur())->getGame($id);
})->setName("game");

$app->get("/api/games", function (){
    (new \src\controleurs\gamecontroleur())->getGames();
})->setName("games");

$app->get("/api/games/:gameid/comments", function ($gameid){
    (new \src\controleurs\gamecontroleur())->getComments($gameid);
})->setName("games");



$db = new DB();
$db->addConnection(parse_ini_file("src/conf/db.config.ini"));
$db->setAsGlobal();
$db->bootEloquent();

$app->run();

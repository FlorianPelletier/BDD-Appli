
<?php
session_start();

use src\models\game;
use src\vue\VueAccueil;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Slim;
use src\controleurs\controleurquestion;

require_once 'vendor/autoload.php';

$app = new Slim();

$app->get('/', function () {

})->setName("Menu");





$db = new DB();
$db->addConnection(parse_ini_file("src/conf/db.config.ini"));
$db->setAsGlobal();
$db->bootEloquent();

$app->run();

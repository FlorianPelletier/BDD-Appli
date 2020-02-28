
<?php
session_start();

use controller\BesoinController;
use controller\CompteController;
use src\vue\VueAccueil;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Slim;

require_once 'vendor/autoload.php';

$app = new Slim();

$app->get('/', function () {
    $vueIndex = new VueAccueil();
    $vueIndex->render(1);
})->setName("Menu");

$db = new DB();
$db->addConnection(parse_ini_file("src/conf/db.config.ini"));
$db->setAsGlobal();
$db->bootEloquent();

$app->run();

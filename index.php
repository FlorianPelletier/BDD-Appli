
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
    $vueIndex = new VueAccueil();
    $vueIndex->render(1);


    $controleur = new src\controleurs\controleurquestion();

    //------QUESTION 1 -----//
    //$controleur->q1();

    ///------QUESTION 2 -----///
    //$controleur->q2();

    ///------QUESTION 3 -----///
    //$controleur->q3();

    ///------QUESTION 4 -----///
    //$controleur->q4();

    ///------QUESTION 5 -----///
    //$controleur->q5();

    //$controleur->question21();


    //$controleur->question27();


})->setName("Menu");

$db = new DB();
$db->addConnection(parse_ini_file("src/conf/db.config.ini"));
$db->setAsGlobal();
$db->bootEloquent();

$app->run();

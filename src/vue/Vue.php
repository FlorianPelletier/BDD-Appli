<?php
namespace src\vue;

use model\User;
use Slim\Slim;

abstract class Vue
{
    public abstract function render($sel);

    protected final function renduTitre()
    {
        return 
          "<!DOCTYPE html>
          <html lang=\"en\">

          <head>

            <meta charset=\"utf-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
            <meta name=\"description\" content=\"\">
            <meta name=\"author\" content=\"\">

            <title>BDD-Appli</title>

          </head>";
    }


    protected final function renduMenu()
    {
        $slim = Slim::getInstance();
        $request = $slim->request;
        return 
          "<body>
            Salut
          </body>";
    }
}

?>

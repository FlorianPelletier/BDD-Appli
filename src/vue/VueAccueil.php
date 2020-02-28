<?php
namespace src\vue;

class VueAccueil extends Vue
{
    public function render($sel)
    {
        $head = parent::renduTitre();
        $menu = parent::renduMenu();

        echo $head . $menu;
    }
}
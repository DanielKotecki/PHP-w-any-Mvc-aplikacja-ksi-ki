<?php

declare(strict_types=1);

namespace App;

class View
{
    public function renderer(string $namePage, array $params = [])
    {
        require_once('src/templates/mainView.php');
    }
    public function renderLoginRegister(string $namePage, array $params = [])
    {
        require_once('src/templates/pages/user/' . $namePage . '.php');
    }
}

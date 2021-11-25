<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\AbstractModel;
use App\Model\BookModel;
use App\Model\CategoriesModel;
use App\View;
use App\Request;
use App\Model\UserModel;

abstract class AbstractController
{
    private static array $configuration = [];

    public View $view;
    protected AbstractModel $db;
    protected CategoriesModel $categories_model;
    protected UserModel $user_model;
    protected BookModel $book_model;
    protected Request $request;
    public final static function init_configuration($config)
    {
        self::$configuration = $config['db'];
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->db = new AbstractModel(self::$configuration);
        $this->categories_model = new CategoriesModel(self::$configuration);
        $this->user_model = new UserModel(self::$configuration);
        $this->book_model = new BookModel(self::$configuration);
        $this->view = new View();
    }
    public function run()
    {

        $action = $this->action() . 'Action';
        $this->$action();
    }
    private function action(): string
    {
        return $this->request->getParam('action', 'list');
    }
}

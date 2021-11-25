<?php

declare(strict_types=1);


namespace App\Model;

use PDO;

class CategoriesModel extends AbstractModel
{

    public function getCategories()
    {
        $query = "SELECT * FROM categories ORDER BY name_categories ";
        $result = $this->connection->query($query);
        $categories = $result->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
}

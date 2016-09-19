<?php

namespace App\Repositories;

use App\Product;

class ProductRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Product();
    }

    public function findByName($q) {
        return $this->model->where('name', 'like', "%$q%")
                           ->get();
    }
}

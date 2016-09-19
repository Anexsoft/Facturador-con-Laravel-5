<?php

namespace App\Repositories;

use App\Client;

class ClientRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Client();
    }

    public function findByName($q) {
        return $this->model->where('name', 'like', "%$q%")
                           ->get();
    }
}

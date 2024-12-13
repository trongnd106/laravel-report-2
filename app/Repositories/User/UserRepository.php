<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository 
{
    public function getModel() {
        return User::class;
    }
    public function get100Users(){
        return $this->model->take(100)->get();
    }

    public function query(){
        return $this->model->query();
    }

    public function findOrFail($id){
        return $this->model->findOrFail($id);
    }
}
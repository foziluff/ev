<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new ($this->getModel());
    }

    abstract protected function getModel(): string;

//    protected function startInit(): Model
//    {
//        return $this->model;
//    }
    protected function startInit(): Builder // TODO потом убрать Builder и работать с Model
    {
        return $this->model->newQuery();
    }
}

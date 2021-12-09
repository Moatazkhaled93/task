<?php

namespace App\Factories;

use App\Interfaces\FactoryInterface;

class ModelFactory implements FactoryInterface
{
    public function create($modelClass)
    {
        return new $modelClass;
    }
}

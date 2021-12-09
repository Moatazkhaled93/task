<?php

namespace App\Repository\Eloquent;

use App\Models\Client;
use App\Repository\Eloquent\EloquentRepository;

/**
 * Description of UserRepository
 */
class ClientRepository extends EloquentRepository
{
    public function getModelName(): string
    {
        return Client::class;
    }
}

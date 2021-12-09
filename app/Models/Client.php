<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\Grid;

class Client extends Model {

    use UsesUuid,
        SoftDeletes,
        Grid;

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'mobile',
        'email',
        'latitude',
        'longitude',
        'address'
        ];

}

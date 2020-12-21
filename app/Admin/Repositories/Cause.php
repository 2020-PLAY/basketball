<?php

namespace App\Admin\Repositories;

use App\Models\Cause as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Cause extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}

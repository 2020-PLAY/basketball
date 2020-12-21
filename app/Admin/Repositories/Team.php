<?php

namespace App\Admin\Repositories;

use App\Models\Team as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Team extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}

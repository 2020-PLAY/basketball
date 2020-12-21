<?php

namespace App\Admin\Repositories;

use App\Models\Class as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Class extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}

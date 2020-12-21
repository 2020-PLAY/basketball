<?php

namespace App\Admin\Repositories;

use App\Models\ClassCard as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ClassCard extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}

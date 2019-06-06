<?php
namespace App\Infrastructure\Repositories;

use App\Entities\Models\M003job;

class M003JobRepository extends BaseRepository implements M003JobRepositoryContract 
{
    public function __construct(M003job $model)
    {
        $this->model = $model;
    }
}
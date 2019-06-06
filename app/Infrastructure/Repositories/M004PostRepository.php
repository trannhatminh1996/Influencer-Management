<?php
namespace App\Infrastructure\Repositories;

use App\Entities\Models\M004Post;

class M004PostRepository extends BaseRepository implements M004PostRepositoryContract 
{
    public function __construct(M004Post $model)
    {
        $this->model = $model;
    }
}
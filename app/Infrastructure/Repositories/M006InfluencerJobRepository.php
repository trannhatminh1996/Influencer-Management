<?php
namespace App\Infrastructure\Repositories;

use App\Entities\Models\M006InfluencerJob;

class M006InfluencerJobRepository extends BaseRepository implements M006InfluencerJobRepositoryContract 
{
    public function __construct(M006InfluencerJob $model)
    {
        $this->model = $model;
    }
}
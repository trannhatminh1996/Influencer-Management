<?php
namespace App\Infrastructure\Repositories;

use App\Entities\Models\M001Influencer;

class InfluencerRepository extends BaseRepository implements InfluencerRepositoryContract 
{
    public function __construct(M001Influencer $model)
    {
        $this->model = $model;
    }
}
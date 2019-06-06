<?php
namespace App\Infrastructure\Repositories;

use App\Entities\Models\M007InfluencerMediaLink;

class M007InfluencerMediaLinkRepository extends BaseRepository implements M007InfluencerMediaLinkRepositoryContract 
{
    public function __construct(M007InfluencerMediaLink $model)
    {
        $this->model = $model;
    }
}
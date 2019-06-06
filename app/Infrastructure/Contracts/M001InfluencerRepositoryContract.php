<?php
namespace App\Infrastructure\Repositories;

interface M001InfluencerRepositoryContract
{
    public function getInfluencer($condition = []);
}
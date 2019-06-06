<?php
namespace App\Domain\Services;

interface InfluencerServiceContract 
{
    public function viewInfluencerList($condition = []);
    public function insert($data = []);
}
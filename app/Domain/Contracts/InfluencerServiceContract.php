<?php
namespace App\Domain\Services;

interface InfluencerServiceContract 
{
    public function getAll($condition = []);
    public function insert($data = []);
    public function update($data = [], $condition = []);
    public function delete($condition = []);
}
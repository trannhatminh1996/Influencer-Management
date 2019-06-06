<?php
namespace App\Domain\Services;

use App\Infrastructure\Repositories\InfluencerRepositoryContract;

class InfluencerService implements InfluencerServiceContract
{
    protected $repository;
    public function __construct(InfluencerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($condition = []) 
    {
        return $this->repository->getAll($condition, ['id', 'name']);
    }

    public function insert($data = []) 
    {
        if ($data) {
            $date = date('Y-m-d H:i:s');
            $data['create_at'] = $date;
            $data['update_at'] = $date;
            return $this->repository->insert($data);
        }
        return false;
    }

    public function update($data = [], $condition = [])
    {
        if ($data && $condition) {
            $date = date('Y-m-d H:i:s');
            $data['update_at'] = $date;
            return $this->repository->update($data, $condition);
        }
        return  false;
    }

    public function delete($condition = [])
    {
        if ($condition) {
            return $this->repository->delete($condition);
        }
        return false;
    }
}
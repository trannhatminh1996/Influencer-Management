<?php
namespace App\Infrastructure\Repositories;

interface BaseRepositoryContract 
{
    public function setAssoc($bool);
    public function getAll($condition = []);
    public function insert($data = []);
    public function update($data = [], $condition = []);
    public function delete($condition = []);
}
<?php
namespace App\Infrastructure\Repositories;

class BaseRepository implements BaseRepositoryContract 
{
    protected $model;

    protected $assoc = true;

    protected function convertFieldsOnList($data)
    {
        $convert = [];
        if ($data) {
            foreach ($data as $field => $val) {
                $convert[$this->model->prefixField . $field] = $val;
            }
        }

        return $convert;
    }

    protected function convertFieldsOnArray($data)
    {
        $convert = [];
        if ($data) {
            foreach ($data as $item) {
                array_push($convert, $this->model->prefixField . $item);
            }
        }
        return $convert;
    }

    public function setAssoc($bool) 
    {
        $this->assoc = $bool;
    }

    public function getAll($condition = [], $field = [] , $orderBy = []) 
    {
        if ($this->assoc) {
            $condition['flag_status'] = config('constant.flag_status.active');
        }
        $condition = $this->convertFieldsOnList($condition);
        $field = $this->convertFieldsOnArray($field);
        $orderBy = $this->convertFieldsOnList($orderBy);
        $data =  $this->model->select($field)->where($condition);
        foreach ($orderBy as $orderByField=>$orderByValue) {
            $data->orderBy($orderByField, $orderByValue);
        }
        return $data->get();
    }

    public function insert($data = [])
    {
        if ($data) {
            $data = $this->convertFieldsOnList($data);

            $this->model->insert($data);
            return true;
        }
        return false;
    }

    public function update($data = [], $condition = [])
    {
        if ($data && $condition) {
            $data = $this->convertFieldsOnList($data);
            $condition = $this->convertFieldsOnList($condition);
            $this->model->where($condition)->update($data);
            return true;
        }
        return false;
    }

    public function delete($condition = [])
    {
        if ($condition) {
            $condition = $this->convertFieldsOnList($condition);
            $this->model->where($condition)->delete();
            return true;
        }
        return false;
    }
}
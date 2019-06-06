<?php
namespace App\Infrastructure\Repositories;

class BaseRepository implements BaseRepositoryContract 
{
    protected $model;

    //Add prefix field to a given data list
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
    //Add prefix field to a given array
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
    //Get information on a single table based on conditions, fields and orderBy conditions
    public function getAll($condition = [], $field = [] , $orderBy = []) 
    {
        $condition['flag_status'] = config('constant.flag_status.active');
        $condition = $this->convertFieldsOnList($condition);
        $field = $this->convertFieldsOnArray($field);
        $orderBy = $this->convertFieldsOnList($orderBy);
        $data =  $this->model->select($field)->where($condition);
        foreach ($orderBy as $orderByField=>$orderByValue) {
            $data->orderBy($orderByField, $orderByValue);
        }
        return $data->get();
    }
    //Insert data
    public function insert($data = [])
    {
        if ($data) {
            $date = date('Y-m-d H:i:s');
            $data['create_at'] = $date;
            $data['update_at'] = $date;
            $data = $this->convertFieldsOnList($data);

            $this->model->insert($data);
            return true;
        }
        return false;
    }
    //update data
    public function update($data = [], $condition = [])
    {
        if ($data && $condition) {
            $date = date('Y-m-d H:i:s');
            $data['update_at'] = $date;
            $data = $this->convertFieldsOnList($data);
            $condition = $this->convertFieldsOnList($condition);
            $this->model->where($condition)->update($data);
            return true;
        }
        return false;
    }
    //delete data
    public function delete($condition = [])
    {
        if ($condition) {
            $condition = $this->convertFieldsOnList($condition);
            $this->model->where($condition)->delete();
            return true;
        }
        return false;
    }
    //Get last inserted data id
    public function getCurrentDataId(){
        $primaryKey =  $this->model->primaryKey;
        return $this->model->orderBy($this->model->getKeyName(),'DESC')->first()->$primaryKey;
    }
    //check if databased contains the data with given conditions
    public function checkContains($condition = []) {
        if ($condition) {
            $condition = $this->convertFieldsOnList($condition);
            $data = $this->model->where($condition)->first();
            return $data;
        }
    }
}
<?php
namespace App\Infrastructure\Repositories;

use App\Entities\Models\M001Influencer;
use DB;

class M001InfluencerRepository extends BaseRepository implements M001InfluencerRepositoryContract 
{
    public function __construct(M001Influencer $model)
    {
        $this->model = $model;
    }
    //View all influencers sastified with the conditions
    public function getInfluencer($condition = []) {
        $data = $this->model
            ->select([
                'f001id as id',
                'f001name as name',
                'f001phone as phone',
                'f001birthday as birthday',
                'f002name as gender',
                'f001email as email',
                'f001address as adress',
                'f001interaction_average_number as interaction_average_number',
                'f001identification_number as identification_number',
                'f001bank_number as bank_number',
            ])
            ->leftJoin('m002gender', function ($joinClause){
                $joinClause->on('f002id','f001gender');
            })
            ->leftJoin('m006influencer_job', function ($joinClause){
                $joinClause->on('f006influencer_id','f001id');
            })
            ->leftJoin('m003job', function ($joinClause){
                $joinClause->on('f003id','f006job_id');
            })
            ->leftJoin('m004post', function ($joinClause){
                $joinClause->on('f004influencer_id','f001id');
            })
            ->leftJoin('m007influencer_media_link', function ($joinClause){
                $joinClause->on('f007influencer_id','f001id');
            })
            ->leftJoin('m005media_type', function ($joinClause){
                $joinClause->on('f005id','f007media_id');
            })
            ->where([
                'f001flag_status' => config('constant.flag_status.active'),
                'f002flag_status' => config('constant.flag_status.active'),
                'f003flag_status' => config('constant.flag_status.active'),
                'f004flag_status' => config('constant.flag_status.active'),
                'f005flag_status' => config('constant.flag_status.active'),
                'f006flag_status' => config('constant.flag_status.active'),
                'f007flag_status' => config('constant.flag_status.active')
            ]);
        if (isset($condition['name'])) {
            $data->where('f001name', 'LIKE', '%' . $condition['name'] . '%');
        }
        if (isset($condition['phone'])) {
            $data->where('f001phone',$condition['phone']);
        }
        if (isset($condition['date_from'])) {
            $data->whereDate('f001birthday', '<=', $condition['date_from']);
        }
        if (isset($condition['date_to'])) {
            $data->whereDate('f001birthday', '>=', $condition['date_to']);
        }
        if (isset($condition['gender'])) {
            $data->where('f001gender',$condition['gender']);
        }
        if (isset($condition['email'])) {
            $data->where('f001email', 'LIKE', '%' . $condition['email'] . '%');
        }
        if (isset($condition['address'])) {
            $data->where('f001address', 'LIKE', '%' . $condition['address'] . '%');
        }
        if (isset($condition['interaction_average_number_from'])) {
            $data->where('f001interaction_average_number', '>=', $condition['interaction_average_number_from']);
        }
        if (isset($condition['interaction_average_number_to'])) {
            $data->where('f001interaction_average_number', '<=', $condition['interaction_average_number_to']);
        }
        if (isset($condition['identification_number'])) {
            $data->where('f001identification_number',$condition['identification_number']);
        }
        if (isset($condition['bank_number'])) {
            $data->where('f001bank_number',$condition['bank_number']);
        }
        if (isset($condition['job'])) {
            $data->where('f003job_title',$condition['job']);
        }
        if (isset($condition['post'])) {
            $data->where('f004post_content', 'LIKE', '%' . $condition['post'] . '%');
        }
        if (isset($condition['media_type'])) {
            $data->where('f005id',$condition['media_type']);
        }
        if (isset($condition['link'])) {
            $data->where('f007link', 'LIKE', '%' . $condition['link'] . '%');
        }
        $data = $data->groupBy('id')->get();
        foreach ($data as $item) {
            $item->job = DB::table('m003job')
                ->select([
                    'f003job_title as job_title',
                ])
                ->join('m006influencer_job', function ($joinClause){
                    $joinClause->on('f006job_id','f003id');
                })
                ->where([
                    'f006influencer_id' => $item->id,
                    'f003flag_status' => config('constant.flag_status.active'),
                    'f006flag_status' => config('constant.flag_status.active')
                ])
                ->get();
            $item->post = DB::table('m004post')
                ->select([
                    'f004post_content as post_content',
                ])
                ->where([
                    'f004influencer_id' => $item->id,
                    'f004flag_status' => config('constant.flag_status.active')
                ])
                ->get();
            $item->link = DB::table('m007influencer_media_link')
                ->select([
                    'f007link as link',
                    'f005media_name as media_type',
                ])
                ->leftJoin('m005media_type', function($joinClause){
                    $joinClause->on('f005id', 'f007media_id');
                })
                ->where([
                    'f007influencer_id' => $item->id,
                    'f005flag_status' => config('constant.flag_status.active'),
                    'f007flag_status' => config('constant.flag_status.active')
                ])
                ->get();
        }
        return $data;
    }

}
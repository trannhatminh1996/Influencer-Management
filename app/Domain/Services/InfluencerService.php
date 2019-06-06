<?php
namespace App\Domain\Services;

use App\Infrastructure\Repositories\M001InfluencerRepositoryContract;
use App\Infrastructure\Repositories\M003JobRepositoryContract;
use App\Infrastructure\Repositories\M004PostRepositoryContract;
use App\Infrastructure\Repositories\M006InfluencerJobRepositoryContract;
use App\Infrastructure\Repositories\M007InfluencerMediaLinkRepositoryContract;

class InfluencerService implements InfluencerServiceContract
{
    protected $influencerRepository;
    protected $jobRepository;
    protected $postRepository;
    protected $influencerJobRepository;
    protected $influencerMediaLinkRepository;
    public function __construct(
        M001InfluencerRepositoryContract $influencerRepository,
        M003JobRepositoryContract $jobRepository,
        M004PostRepositoryContract $postRepository,
        M006InfluencerJobRepositoryContract $influencerJobRepository,
        M007InfluencerMediaLinkRepositoryContract $influencerMediaLinkRepository
    )
    {
        $this->influencerRepository = $influencerRepository;
        $this->jobRepository = $jobRepository;
        $this->postRepository = $postRepository;
        $this->influencerJobRepository = $influencerJobRepository;
        $this->influencerMediaLinkRepository = $influencerMediaLinkRepository;
    }

    //View influencer list
    public function viewInfluencerList($condition = []) 
    {
        // Get condition of year based on age
        if (isset($condition['age_from'])) {
            $ageFrom = strtotime('-' . $condition['age_from'] . ' year', time());
            $condition['date_from'] =  date("Y-m-d", $ageFrom);
        }
        if (isset($condition['age_to'])) {
            $ageTo = strtotime('-' . $condition['age_to'] . ' year', time());
            $condition['date_to'] =  date("Y-m-d", $ageTo);
        }
        return $this->formattedData($this->influencerRepository->getInfluencer($condition));
    }

    //insert an influencer
    public function insert($data = []) 
    {
        if ($data) {
            $influencerData = $this->formattedInfluencerData($data);
            $this->influencerRepository->insert($influencerData);
            $influencerCurrentId = $this->influencerRepository->getCurrentDataId();//Get inserted influencer id
            if ($data['job']) {
                foreach ($data['job'] as $job) {
                    $jobCheck = $this->jobRepository->checkContains(['job_title' => $job]);//Check if job has already in the database
                    if (empty($jobCheck)){//if not then add this new job and add this job to the influencer
                        $this->jobRepository->insert(['job_title' => $job]);
                        $jobCurrentId = $this->jobRepository->getCurrentDataId();
                        $this->influencerJobRepository->insert(['influencer_id' => $influencerCurrentId, 'job_id' => $jobCurrentId]);
                    }
                    else {//else add the found job to the influencer
                        $this->influencerJobRepository->insert(['influencer_id' => $influencerCurrentId, 'job_id' => $jobCheck->f003id]);
                    }
                }
            }
            if ($data['post']) {//Add post to the influencer
                foreach ($data['post'] as $post) {
                    $this->postRepository->insert(['influencer_id' => $influencerCurrentId, 'post_content' => $post]);
                }
            }
            if ($data['link']) {//Add link to the influencer
                foreach ($data['link'] as $type => $link) {
                    $this->influencerMediaLinkRepository->insert(['influencer_id' => $influencerCurrentId, 'media_id' => $type, 'link' => $link]);
                }
            }
        }
    }

    //Formatted and get all data needed for influencer (table m001)
    private function formattedInfluencerData($data) 
    {
        $dataReturn = [];
        if (isset($data['name'])) {
            $dataReturn['name'] =$data['name'];
        }
        if (isset($data['phone'])) {
            $dataReturn['phone'] = $data['phone'];
        }
        if (isset($data['birthday'])) {
            $dataReturn['birthday'] = $data['birthday'];
        }
        if (isset($data['gender'])) {
            $dataReturn['gender'] = $data['gender'];
        }
        if (isset($data['email'])) {
            $dataReturn['email'] = $data['email'];
        }
        if (isset($data['address'])) {
            $dataReturn['address'] = $data['address'];
        }
        if (isset($data['interaction_average_number'])) {
            $dataReturn['interaction_average_number'] = $data['interaction_average_number'];
        }
        if (isset($data['identification_number'])) {
            $dataReturn['identification_number'] = $data['identification_number'];
        }
        if (isset($data['bank_number'])) {
            $dataReturn['bank_number'] = $data['bank_number'];
        }
        return $dataReturn;
    }

    private function formattedData($modelData) 
    {
        $returnData = [];
        foreach ($modelData as $key => $item) {
            $returnData[$key]['name'] = $item->name;
            $returnData[$key]['phone'] = $item->phone;
            $returnData[$key]['birthday'] = $item->birthday;
            $returnData[$key]['gender'] = $item->Male;
            $returnData[$key]['email'] = $item->email;
            $returnData[$key]['adress'] = $item->adress;
            $returnData[$key]['interaction_average_number'] = $item->interaction_average_number;
            $returnData[$key]['identification_number'] = $item->identification_number;
            $returnData[$key]['bank_number'] = $item->bank_number;
            foreach ($item->job as $job) {
                $returnData[$key]['job'][] = $job->job_title;
            }
            foreach ($item->post as $post) {
                $returnData[$key]['post'][] = $post->post_content;
            }
            foreach ($item->link as $link) {
                $returnData[$key]['link'][$link->media_type] = $link->link;
            }
        }
        return $returnData;
    }
}
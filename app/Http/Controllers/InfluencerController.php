<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Services\InfluencerServiceContract;

class InfluencerController extends Controller
{
    public function index() {
        $influencerService = app(InfluencerServiceContract::class);
        //insert data example 
        $insertData = [
            'name' => 'Tran Nhat Minh',
            'phone' => '0356633488', //optional
            'birthday' => '1996-06-20',
            'gender' => 1,
            'email' => 'tnminh@apcs.vn',
            'address' => '378/1 An Duong Vuong',
            'interaction_average_number' => 5,
            'identification_number' => 1321321321,//optional
            'bank_number' => 123213123213,//optional
            'job' => [
                'Developer',
                'Guitarist',
            ],
            'post' => [
                'How to think outside-of-a-box as a Developer?',
                'Fastway to accomplish a guitar solo?',
            ],
            'link' => [
                1 => 'https://facebook.com/tran-minh',
                2 => 'tnminh@apcs.vn',
            ],
        ];
        //Search condition example
        $searchCondition = [
            'name' => 'Minh',
            'phone' => '0356633488',
            'age_from' => 10,
            'age_to' => 24,
            'gender' => 1,
            'email' => 'tnminh',
            'address' => 'An D',
            'interaction_average_number_from' => 4,
            'interaction_average_number_to' => 10,
            'identification_number' => 1321321321,
            'bank_number' => 123213123213,
            'job' => 'Developer',
            'post' => 'How',
            'media_type' => 1,
            'link' => 'facebook',
        ];

        //Call this function to insert influencer information
        //$influencerService->insert($insertData);

        //view all influencers' information as below
        //$influencerService->viewInfluencerList();

        //search for influencers by condition as  below
        //$influencerService->viewInfluencerList($searchCondition);
    }
}
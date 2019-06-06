<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Services\InfluencerServiceContract;
use Illuminate\Http\Request;

class InfluencerController extends Controller
{
    public function view(Request $request) 
    {
        $searchCondition = $request->all();
        $influencerService = app(InfluencerServiceContract::class);
        //Search condition example
        dd($influencerService->viewInfluencerList($searchCondition));
        //Example of search condition paramss
        // $searchCondition = [
        //     'name' => 'Minh',
        //     'phone' => '0356633488',
        //     'age_from' => 10,
        //     'age_to' => 24,
        //     'gender' => 1,
        //     'email' => 'tnminh',
        //     'address' => 'An D',
        //     'interaction_average_number_from' => 4,
        //     'interaction_average_number_to' => 10,
        //     'identification_number' => 1321321321,
        //     'bank_number' => 123213123213,
        //     'job' => 'Developer',
        //     'post' => 'How',
        //     'media_type' => 1,
        //     'link' => 'facebook',
        // ];
    }

    public function insert(Request $request) 
    {
        $insertData = $request->all();
        $influencerService = app(InfluencerServiceContract::class);
        $influencerService->insert($insertData);

        //insert data example params
        // $insertData = [
        //     'name' => 'Tran Nhat Minh',
        //     'phone' => '0356633488', //optional
        //     'birthday' => '1996-06-20',
        //     'gender' => 1,
        //     'email' => 'tnminh@apcs.vn',
        //     'address' => '378/1 An Duong Vuong',
        //     'interaction_average_number' => 5,
        //     'identification_number' => 1321321321,//optional
        //     'bank_number' => 123213123213,//optional
        //     'job' => [
        //         'Developer',
        //         'Guitarist',
        //     ],
        //     'post' => [
        //         'How to think outside-of-a-box as a Developer?',
        //         'Fastway to accomplish a guitar solo?',
        //     ],
        //     'link' => [
        //         1 => 'https://facebook.com/tran-minh',
        //         2 => 'tnminh@apcs.vn',
        //     ],
        // ];
    }

    public function testParagraph(Request $request)
    {
        $data = $request->all();
        if (isset($data['paragraph']) && isset($data['nWord'])) {
            dd(mostUsedWords($data['paragraph'], $data['nWord']));
        }
        //Example of input data
        // $inputData = [
        //     'paragraph' => 'Nivea đang có chương trình khuyến mãi hấp dẫn. Hãy sử dụng Nivea, nhắc lại là rất hấp dẫn nha :)',
        //     'nWord' => 3
        // ];
    }

    public function testMaxPrimeNumber(Request $request)
    {
        $data = $request->all();
        if (isset($data['number'])) {
            return getMaximumPrimeNumberOnIntegerElement($data['number']);
        }
        //Example of input data
        // $inputData = [
        //     'number' => 117
        // ];
    }
}
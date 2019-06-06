<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('influencer/view',['as'=>'influencer.view', 'uses'=> 'InfluencerController@view']);
Route::get('influencer/insert', ['as'=>'influencer.insert', 'uses'=> 'InfluencerController@insert']);
Route::get('influencer/testParagraph', ['as'=>'influencer.test_paragraph', 'uses'=> 'InfluencerController@testParagraph']);
Route::get('influencer/testMaxPrimeNumber', ['as'=>'influencer.test_max_prime_number', 'uses'=> 'InfluencerController@testMaxPrimeNumber']);

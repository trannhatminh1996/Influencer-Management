<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Services\InfluencerServiceContract;

class InfluencerController extends Controller
{
    public function index() {
        $influencerService = app(InfluencerServiceContract::class);
    }
}
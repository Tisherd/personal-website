<?php

namespace App\Http\Controllers;

use App\Services\GoogleTableSyncService;

class TestGoogleController extends Controller
{
    public function index(GoogleTableSyncService $service)
    {
        // $result = $service->getValues();

        // dd($result);
    }
}

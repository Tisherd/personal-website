<?php

namespace App\Http\Controllers;

use App\Services\GoogleTableSyncService;

class TestGoogleController extends Controller
{
    public function index(GoogleTableSyncService $service)
    {
        // $result = $service->getValues();

        // dd($result);

        dd($service->setWorkSheet("1OBcxuiLIXI8o9QrntSaDqbxY-2q_i_tXVuJ8QiuPX58_22"));
    }
}

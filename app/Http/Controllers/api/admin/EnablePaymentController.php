<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\api\student\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\visaenable;
use Illuminate\Http\Request;

class EnablePaymentController extends Controller
{
    use apiResponse;
    public function index()
    {
        $enables = visaenable::first();
        return $this->success($enables, 'Successfully Fetched');
    }
}

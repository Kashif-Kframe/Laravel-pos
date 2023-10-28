<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanies()
    {
        return Helper::apiResponse(Company::all());
    }
}

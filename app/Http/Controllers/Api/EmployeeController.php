<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function getEmployees($id = null)
    {
        $employees = Employee::query()->when($id , function ($q) use($id) {
            $q->where('company_id', $id);
        })->orderByDesc('id')->get();

        return Helper::apiResponse($employees);
    }
}

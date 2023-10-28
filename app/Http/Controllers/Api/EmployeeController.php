<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function getEmployees($id = null)
    {
        $query = Employee::query();
        if ($id) {
            $query->where('company_id', $id);
        }
        $employees = $query->get();
        return Helper::apiResponse($employees);
    }
}

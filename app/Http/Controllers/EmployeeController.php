<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    private $redirectTo = 'employee';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::query()->orderByDesc('id')->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all(['id', 'name']);
        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $company = Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone ?? '',
                'company_id' => $request->company_id ?? 0,
            ]);
            if ($company) {
                return redirect()->to($this->redirectTo)->with('success', "Employee created successfully!");
            }
            return redirect()->back()->with('error', "Employee failed to created!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all(['id', 'name']);
        return view('employee.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Employee $employee)
    {
        try {
            $update = $employee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone ?? '',
                'company_id' => $request->company_id ?? 0,
            ]);
            if ($update) {
                return redirect()->to($this->redirectTo)->with('success', "Employee updated successfully!");
            }
            return redirect()->back()->with('error', "Employee failed to updated!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->back()->with('success', "Employee deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

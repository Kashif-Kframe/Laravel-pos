<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;

class CompanyController extends Controller
{

    private $redirectTo = 'company';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::query()->orderByDesc('id')->paginate(10);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $company = Company::create([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website ?? '',
                'logo' => Helper::uploadFile($request),
            ]);
            if ($company) {
                Helper::sendEmail($company);
                return redirect()->to($this->redirectTo)->with('success', "Company created successfully!");
            }
            return redirect()->back()->with('error', "Company failed to created!");
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
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Company $company)
    {
        try {
            $update = $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website ?? '',
                'logo' => Helper::uploadFile($request, $company->logo ?? ''),
            ]);
            if ($update) {
                return redirect()->to($this->redirectTo)->with('success', "Company updated successfully!");
            }
            return redirect()->back()->with('error', "Company failed to updated!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return redirect()->back()->with('success', "Company deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}

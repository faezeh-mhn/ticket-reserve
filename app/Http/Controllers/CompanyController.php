<?php

namespace App\Http\Controllers;

use App\Interfaces\CompanyRepo;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function show(CompanyRepo $companyRepo)
    {
        $companies = $companyRepo->show();
        return response()->json([
            'companies' => $companies
        ]);

    }
}

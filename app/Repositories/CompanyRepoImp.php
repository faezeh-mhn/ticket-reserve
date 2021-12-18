<?php


namespace App\Repositories;

use App\Interfaces\CompanyRepo;
use App\Models\Company;

class CompanyRepoImp implements CompanyRepo
{
    public function show()
    {
        $company = Company::get();//return an array
        $companies = [];

        foreach ($company as $co) {
            $companies[] = $co->name;

        }
        return $companies;
}
}

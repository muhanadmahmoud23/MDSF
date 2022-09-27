<?php

namespace App\Http\Traits;

use App\Models\ACCOUNTS;
use App\Models\BRANCHES;
use App\Models\PRODUCT_COMPANY;

trait DBRetrive
{
    public function branches()
    {
        $branches = BRANCHES::select('BRANCH_CODE', 'BRANCH_NAME')
            ->orderBy('BRANCH_NAME')
            ->distinct()
            ->get();
        return $branches;
    }

    public function companies()
    {
        $companies = PRODUCT_COMPANY::select('COMPANY_ID', 'COMPANY_NAME')
            ->where('COMPANY_FLAG', 1)
            ->where('COMPANY_SEQ', '!=', null)
            ->orderBy('COMPANY_NAME')
            ->distinct()
            ->get();
        return  $companies;
    }

    public function accounts()
    {
        $accounts = ACCOUNTS::select('ACC_ID', 'ACC_DESC')
            ->orderBy('ACC_DESC')
            ->distinct()
            ->get();
        return $accounts;
    }
}

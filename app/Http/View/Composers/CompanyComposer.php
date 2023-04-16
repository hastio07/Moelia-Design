<?php

namespace App\Http\View\Composers;

use App\Models\Company;
use Illuminate\View\View;

class CompanyComposer
{
    public function compose(View $view)
    {
        $companies = Company::first(); // ganti query ini dengan query yang sesuai untuk mendapatkan perusahaan yang ingin ditampilkan
        $view->with('companies', $companies);
    }
}

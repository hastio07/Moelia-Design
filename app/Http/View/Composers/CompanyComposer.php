<?php

namespace App\Http\View\Composers;

use App\Models\Company;
use App\Models\Address;
use App\Models\Sosmed;
use Illuminate\View\View;

class CompanyComposer
{
    public function compose(View $view)
    {
        $companies = Company::first();
        $addresses = Address::first(); // ganti query ini dengan query yang sesuai untuk mendapatkan perusahaan yang ingin ditampilkan
        $sosmed = Sosmed::get();
        $view->with(['companies' => $companies, 'sosmed' => $sosmed, 'addresses' => $addresses]);
    }
}

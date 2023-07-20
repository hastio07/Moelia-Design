<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Employee;
use App\Models\Offer;
use App\Models\Owner;
use App\Models\Sosmed;
use App\Models\WorkingHour;
use App\Models\Certificate;
class AboutController extends Controller
{
    public function index()
    {
        //Offer
        $offers = Offer::first();
        //Address
        $addresses = Address::first();
        //Contact
        $contacts = Contact::first();
        //Owner
        $owners = Owner::first();
        //pegawai
        $employe = Employee::with('categoryjabatan')->where('show_data', '=', 'ya')->get();
        //jam operasional
        $workinghour = WorkingHour::get();
        //sosial media
        $sosmed = Sosmed::get();
        //sertifikat
        $certificates = Certificate::first();

        return view('user.aboutus', compact('offers', 'addresses', 'contacts', 'owners', 'employe', 'workinghour', 'sosmed', 'certificates'));
    }
}

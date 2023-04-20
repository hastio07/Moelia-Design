<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Offer;

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

        return view('dashboard.user.aboutus', compact('offers', 'addresses', 'contacts'));
    }
}

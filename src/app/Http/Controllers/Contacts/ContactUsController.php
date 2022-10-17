<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function create()
    {
        return view('contacts.contact-us.create');
    }

    public function store()
    {
        // proccess contact us form
    }
}

<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function create()
    {
        return view('about.contact-us.create');
    }

    public function store()
    {
        // proccess contact us form
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Contact extends Controller
{
    public function contactUs()
    {
        return view("pages.Contact-us");
    }
    public function aboutUs()
    {
        return view("pages.About-us");
    }



}

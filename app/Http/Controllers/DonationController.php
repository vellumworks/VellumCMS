<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View
    {
        return view('donations.index');
    }
}

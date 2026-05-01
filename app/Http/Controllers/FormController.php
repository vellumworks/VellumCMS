<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FormController extends Controller
{
    public function index(): View
    {
        return view('forms.index');
    }
}

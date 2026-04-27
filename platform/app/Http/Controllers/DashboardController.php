<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $org  = $user->organisation;

        return view('dashboard.index', compact('user', 'org'));
    }

    public function pending(): View
    {
        return view('dashboard.pending', ['org' => auth()->user()->organisation]);
    }
}

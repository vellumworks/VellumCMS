<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View        { return view('public.home'); }
    public function about(): View       { return view('public.about'); }
    public function features(): View    { return view('public.features'); }
    public function noCosts(): View     { return view('public.no-costs'); }
    public function howItWorks(): View  { return view('public.how-it-works'); }
    public function faqs(): View        { return view('public.faqs'); }
    public function contact(): View     { return view('public.contact'); }
    public function roadmap(): View     { return view('public.roadmap'); }
    public function legal(): View       { return view('public.legal.index'); }
    public function privacy(): View     { return view('public.legal.privacy-policy'); }
    public function terms(): View       { return view('public.legal.terms'); }
    public function cookies(): View     { return view('public.legal.cookie-policy'); }
}

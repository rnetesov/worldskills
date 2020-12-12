<?php

namespace App\Http\Controllers;

use App\Entities\Proposal;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('my.auth')->only('store');
    }

    public function index()
    {
        $proposals = Proposal::whereStatus(Proposal::STATUS_SOLVED)->orderByDesc('created_at')->limit(4)->get();
        return view('home', compact('proposals'));
    }
}

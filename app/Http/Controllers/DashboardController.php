<?php

namespace App\Http\Controllers;

use App\Models\UserPromo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $promoCode = UserPromo::where('user_id', auth()->user()->id)->pluck('promo_code') ?? null;
        return view('dashboard', compact('promoCode'));
    }
}

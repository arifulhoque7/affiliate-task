<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function commission()
    {
        $headerText = 'Commission';
        if(auth()->user()->type != 1){
            $commissions = auth()->user()->commissions()->with(['createdBy'])->latest()->get();
            $totalCommission = auth()->user()->commissions()->sum('commission');
        }else{
            $commissions = Commission::with(['user', 'createdBy'])->latest()->get();
            $totalCommission = Commission::sum('commission');
        }

        return view('commission', compact('commissions', 'headerText', 'totalCommission'));
    }
}

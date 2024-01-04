<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPromo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubAffiliateUserController extends Controller
{
    public function index()
    {
        $users = User::where('type', 3)->get();
        $headerText = 'Sub Affiliate User List';
        $user_create_route = 'subAffiliate.store';
        return view('user_list', compact('users', 'headerText', 'user_create_route'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'dob' => 'required',
            'password' => 'required',
        ]);
        $promoCode = Str::random(8);
        $data['type'] = 3;
        $data['password'] = Hash::make($data['password']);
        $data['created_by'] = auth()->user()->id;

        $user = User::create($data);
        // user promo code add
        $user->userPromo()->create([
            'promo_code' => $promoCode,
        ]);

        return redirect()->route('subAffiliate.index');
    }
}

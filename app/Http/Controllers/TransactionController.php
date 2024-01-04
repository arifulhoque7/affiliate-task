<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPromo;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommissionNotification;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->transactions()->latest()->get();
        $headerText = 'Transactions';
        return view('transaction', compact('transactions', 'headerText'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'details' => 'string',
        ]);

        // Begin a database transaction
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $transaction = $user->transactions()->create([
                'amount' => $request->amount,
                'details' => $request->details,
            ]);

            $affiliateUserPromo = UserPromo::where('promo_code', $user->promo_code)->first();
            $affiliateUser = User::find($affiliateUserPromo->user_id);

            if ($affiliateUser) {
                if ($affiliateUser->type == 2) {
                    $commissionAmountAff = $request->amount * 0.3;
                } else {
                    $commissionAmountAff = $request->amount * 0.1;
                }
                
                $commission = Commission::create([
                    'user_id' => $affiliateUser->id,
                    'transaction_id' => $transaction->id,
                    'amount' => $request->amount,
                    'commission' => $commissionAmountAff,
                    'created_by' => $user->id,
                    'created_at' => now(),
                ]);
    
                // Send notification to affiliate user
                Notification::send($affiliateUser, new CommissionNotification($commission));
                
                if ($affiliateUser->type == 3) {
                    $subAffiliateUser = User::find($affiliateUser->created_by);

                    if ($subAffiliateUser) {
                        $commissionAmountSubAff = $request->amount * 0.2;

                        $commission = Commission::create([
                            'user_id' => $subAffiliateUser->id,
                            'transaction_id' => $transaction->id,
                            'amount' => $request->amount,
                            'commission' => $commissionAmountSubAff,
                            'created_by' => $user->id,
                            'created_at' => now(),
                        ]);
                    }
                }
            }
            // Commit the database transaction
            DB::commit();

            return redirect()->back()->with('success', 'Transaction created successfully');
        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Transaction creation failed: ' . $e->getMessage());
        }
    }
}

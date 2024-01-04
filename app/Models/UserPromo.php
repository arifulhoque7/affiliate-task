<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPromo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'promo_code',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

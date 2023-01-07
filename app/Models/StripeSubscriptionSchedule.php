<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeSubscriptionSchedule extends Model
{
    use HasFactory;
    protected $table = 'stripe_subscription_schedules';

    protected $fillable = [
        "user_id",
        "subscription_schedule_id"
    ];
}

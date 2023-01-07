<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe;

class UpgradePreferenceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $planArr = array();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $plans = Stripe\Plan::all()->data;
            foreach ($plans as $plan) {
                if($plan->active && isset($plan->nickname) && isset($plan->amount) && isset($plan->transform_usage->divide_by)) {
                    $temp = array();
                    $temp['id'] = $plan->id;
                    $temp['name'] = $plan->nickname;
                    $temp['price'] = ((float)$plan->amount /100) .'$';
                    $temp['wordCountString'] = (string)number_format($plan->transform_usage->divide_by);
                    $temp['wordCount'] = $plan->transform_usage->divide_by;
                    array_push($planArr,$temp);
                }
            }

        if($this->user->upgrade_preference == 'subscription'){
            if($this->user->subscribed('Typeskip.ai')){
                $subscription = $this->user->subscription('Typeskip.ai');
                $planIndex = array_search($subscription->stripe_plan, array_column($planArr, 'id'));
                if($planIndex){
                    $plan = $planArr[$planIndex - 1];
                    $stripe_plan = $plan['id'];

                }else{
                    return false;
                }
                $this->user->subscription('staging.typeskip.ai',[
                    'prorate' => false,
                    'proration_behavior' => 'none',
                ])->noProrate()->skipTrial()->swapAndInvoice($stripe_plan);

                /*if($subscription->stripe_plan == 'price_1IfQxvCVhYqASAhcdnMdk7Mb') //25000
                    $stripe_plan = 'price_1IfQzFCVhYqASAhcsJGZLUxD';//55000
                if($subscription->stripe_plan == 'price_1IfQzFCVhYqASAhcsJGZLUxD')//55000
                    $stripe_plan = 'price_1IfR0yCVhYqASAhcDpOWkg9c';//110000
                if($subscription->stripe_plan == 'price_1IfR0yCVhYqASAhcDpOWkg9c')//110000
                    $stripe_plan = 'price_1IfR2mCVhYqASAhczbaoVix9';//165000
                if($subscription->stripe_plan == 'price_1IfR2mCVhYqASAhczbaoVix9')//165000
                    $stripe_plan = 'price_1IfR4YCVhYqASAhcW5fhmvmT';//265000
                if($subscription->stripe_plan == 'price_1IfR4YCVhYqASAhcW5fhmvmT')//265000
                    return false;

                $this->user->subscription('Typeskip.ai')->swapAndInvoice($stripe_plan);*/
            }
        }else {
            $this->user->invoiceFor($this->user->upgrade_preference.' Words Addon',1000, [
               // 'quantity' => $this->user->upgrade_preference,
                /*'unit_amount' => 001,*/
            ]);
        }
    }
}

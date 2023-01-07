<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Trail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;

class InvoicePaymentSucceeded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /** @var WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        Log::error('InvoicePaymentSucceeded =>'. json_encode($this->webhookCall->payload));

        $charge = $this->webhookCall->payload['data']['object'];
        $user = User::whereStripeId($charge['customer'])->first();
        if($user){

            $Trail = Trail::whereUserId($user->id)->first();
            $trailBonus = $Trail->trail_bonus;

            // For addon instant invoice
            if($charge['billing_reason'] == 'manual'){
                //$wordCount = $charge['lines']['data'][0]['quantity'];
                $wordCount = $charge['lines']['data'][0]['amount'] * 10;
                Trail::whereUserId($user->id)->update(['trail_quantity' => $Trail->trail_quantity + $wordCount]);
            }

            // After cycle subscription payment
            if($charge['billing_reason'] == 'subscription_cycle'){
                $wordCount = $charge['lines']['data'][0]['price']['transform_quantity']['divide_by'];
                Trail::whereUserId($user->id)->update(['trail_quantity' => $wordCount]);
            }

            if($charge['billing_reason'] == 'subscription_create'){
                $wordCount = 0;
                if($charge['lines']['data'][0]['price']['transform_quantity'] !== null){
                    $wordCount = $charge['lines']['data'][0]['price']['transform_quantity']['divide_by'];
                }
                Trail::whereUserId($user->id)->update(['trail_quantity' => $Trail->trail_quantity + $wordCount]);
            }

            if($charge['billing_reason'] == 'subscription_update'){
                // if user upgrade or downgrade subscription it will handle Trails count
                if(isset($charge['lines']['data'][1])){
                    $wordCount = $charge['lines']['data'][1]['price']['transform_quantity']['divide_by'] - $charge['lines']['data'][0]['price']['transform_quantity']['divide_by'];
                    $wordCount = $Trail->trail_quantity + $wordCount;
                }else{

                    $wordCount = $charge['lines']['data'][0]['price']['transform_quantity']['divide_by'];
                }
                //40000
                //if trail_quantity greater then 0 if will deduct from trail_bonus
                /*if($Trail->trail_quantity > 0)
                    $trailBonus = ($Trail->trail_quantity < $wordCount)?($Trail->trail_bonus + ($Trail->trail_quantity + $wordCount)):$trailBonus;
                else
                    $trailBonus = $Trail->trail_bonus + $wordCount;*/
                // It will make sure that we will not add less then 0 for trail_quantity and trail_bonus
                /*$wordCount = ($Trail->trail_quantity < $wordCount)?($Trail->trail_quantity + $wordCount):0;
                $trailBonus = $trailBonus > 0?$trailBonus:0;*/
                //$wordCount = $Trail->trail_quantity + $wordCount;
                Trail::whereUserId($user->id)->update(['trail_quantity' => $wordCount, 'trail_bonus' => $trailBonus]);
            }
        }
    }
}

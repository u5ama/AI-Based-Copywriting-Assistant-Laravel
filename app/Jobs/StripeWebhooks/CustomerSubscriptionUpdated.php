<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\User;
use App\Notifications\StripeCustomerSubscriptionUpdated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class CustomerSubscriptionUpdated implements ShouldQueue
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
        $charge = $this->webhookCall->payload['data']['object'];
        $user = User::whereStripeId($charge['customer'])->first();
        if($user){
            // send notification email to user
            $user->notify(new StripeCustomerSubscriptionUpdated());
        }
    }
}

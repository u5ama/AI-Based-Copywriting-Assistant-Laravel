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

class CustomerSubscriptionDeleted implements ShouldQueue
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
        Log::error('CustomerSubscriptionDeleted =>'. json_encode($this->webhookCall->payload));
        $charge = $this->webhookCall->payload['data']['object'];
        $user = User::whereStripeId($charge['customer'])->first();
        if($user){
            // reset count to zero
            Trail::whereUserId($user->id)->update(['trail_quantity' => 0]);
        }
    }
}

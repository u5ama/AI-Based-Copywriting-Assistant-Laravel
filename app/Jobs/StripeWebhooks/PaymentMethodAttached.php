<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\User;
use App\Notifications\StripePaymentMethodAttached;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;

class PaymentMethodAttached implements ShouldQueue
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
        Log::info(json_encode($this->webhookCall->payload['data']));
        $charge = $this->webhookCall->payload['data']['object'];
        $user = User::whereStripeId($charge['customer'])->first();
        if($user){
            //send notification email to user
            $user->notify(new StripePaymentMethodAttached());
        }
    }
}

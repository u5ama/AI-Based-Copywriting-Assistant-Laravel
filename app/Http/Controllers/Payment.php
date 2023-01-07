<?php

namespace App\Http\Controllers;

use App\Models\StripeSubscriptionSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe;
use App\Models\UserSubscription;
use App\Models\Pricing;

class Payment extends Controller
{
    /**
     * Creates an intent for payment so we can capture the payment
     * method for the user.
     *
     * @return mixed
     */
    public function getSetupIntent()
    {
        return auth()->user()->createSetupIntent();
    }

    /**
     * Returns the payment methods the user has saved
     *
     * @param Request $request The request data from the user.
     */
    public function getPaymentMethods( Request $request )
    {
        $user = auth()->user();
        $methods = array();
        if( $user->hasPaymentMethod() ){
            foreach( $user->paymentMethods() as $method ){
                array_push( $methods, [
                    'id' => $method->id,
                    'brand' => $method->card->brand,
                    'last_four' => $method->card->last4,
                    'exp_month' => $method->card->exp_month,
                    'exp_year' => $method->card->exp_year,
                ] );
            }
        }
        return response()->json( $methods );
    }

    /**
     * Returns the subscriptions the user has saved
     *
     * @param Request $request The request data from the user.
     * @throws Stripe\Exception\ApiErrorException
     */
    public function getSubscription( Request $request )
    {
        $user = auth()->user();
        $subscriptions = array();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if( $user->subscriptions && $user->subscribed('Typeskip.ai') ){
            foreach( $user->subscriptions()->get() as $subscription ){
                array_push( $subscriptions, [
                    'id' => $subscription->id,
                    'name' => $subscription->name,
                    'stripe_status' => $subscription->stripe_status,
                    'quantity' => $subscription->quantity,
                    'ends_at' => $subscription->ends_at,
                    'meta_data' => Stripe\Subscription::retrieve($subscription->stripe_id),
                ] );
            }
        }
        return response()->json( $subscriptions );
    }

    public function getPlan()
    {
        $planArr = array();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $plans = Stripe\Plan::all()->data;
            // add default select
            $temp = array();
            $temp['id'] = 0;
            $temp['name'] = 'Select Plan';
            $temp['price'] = '0$';
            $temp['wordCountString'] = '0';
            $temp['wordCount'] = 0;

            array_push($planArr,$temp);

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
        }
        catch (\Exception $e) {
            //have currently nothing
        }
        return response()->json( $planArr );
    }

    public function getScheduleSubscription()
    {
        $subscription_schedule = auth()->user()->getStripeSubscriptionSchedule;
        $subscription_schedule_date = '';
        if($subscription_schedule) {
            $subscription_schedule_id = $subscription_schedule->subscription_schedule_id;
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $schedule = \Stripe\SubscriptionSchedule::retrieve($subscription_schedule_id);
            if($schedule) {
                $subscription_schedule_date = $schedule->phases[0]->start_date;
            }
        }
        return response()->json( $subscription_schedule_date );
    }

    /**
     * Removes a payment method for the current user.
     *
     * @param Request $request The request data from the user.
     */
    public function removePaymentMethod( Request $request )
    {
        $user = auth()->user();
        $paymentMethodID = $request->get('id');
        $paymentMethods = $user->paymentMethods();
        foreach( $paymentMethods as $method ){
            if( $method->id == $paymentMethodID ){
                $method->delete();
                break;
            }
        }
        return response()->json( null, 204 );
    }

    public function subscription(Request $request)
    {
        $currency = "USD";
        $token = $request->stripeToken;
        $plans = $this->plans();
         // Plan info
        $planID =1;
        $pakage = Pricing::where('duration',$request->input('duration'))->first();
        $pakage->price = $this->percentage($pakage->discount,$pakage->price);
        $planInfo = $plans[$planID];
        $planName = $pakage->duration.'lmonth Subscription';
        $planPrice = $pakage->price;
        $planInterval = $pakage->duration;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Add customer to stripe
        try {
            $customer = \Stripe\Customer::create(array(
                'email' => $request->stripeEmail,
                'source'  => $token
            ));
        }catch(Exception $e) {
            $api_error = $e->getMessage();
        }
        if(empty($api_error) && $customer){
            // Convert price to cents
            $priceCents = round($planPrice*100);

            // Create a plan
            try {
                $plan = \Stripe\Plan::create(array(
                    "product" => [
                        "name" => $planName
                    ],
                    "amount" => $priceCents,
                    "currency" => $currency,
                    "interval" => $planInterval,
                    "interval_count" => 1
                ));
            }
            catch(Exception $e) {
                $api_error = $e->getMessage();
            }

            if(empty($api_error) && $plan){
                // Creates a new subscription
                try {
                    $subscription = \Stripe\Subscription::create(array(
                        "customer" => $customer->id,
                        "items" => array(
                            array(
                                "plan" => $plan->id,
                            ),
                        ),
                    ));
                }
                catch(Exception $e) {
                    $api_error = $e->getMessage();
                }

                if(empty($api_error) && $subscription){
                    // Retrieve subscription data
                    $subsData = $subscription->jsonSerialize();
                    // Check whether the subscription activation is successful
                    if($subsData['status'] == 'active'){
                        // Subscription info
                        $planresponse = array(
                            'user_id'=>$this->data['user']['userID'],
                            'stripe_subscription_id'=>$subsData['id'],
                            'stripe_customer_id'=>$subsData['customer'],
                            'stripe_plan_id'=>$subsData['plan']['id'],
                            'plan_amount'=>($subsData['plan']['amount']/100),
                            'plan_amount_currency'=>$subsData['plan']['currency'],
                            'plan_interval'=> $subsData['plan']['interval'],
                            'plan_interval_count'=>$subsData['plan']['interval_count'],
                            'payer_email'=>$this->data['user']['email'],
                            'created'=>date("Y-m-d H:i:s", $subsData['created']),
                            'plan_period_start'=>date("Y-m-d H:i:s", $subsData['current_period_start']),
                            'plan_period_end'=>date("Y-m-d H:i:s", $subsData['current_period_end']),
                            'status'=>$subsData['status']
                        );
                        $response = UserSubscription::insert($planresponse);
                        if($response){
                            $request->session()->flash('subscription', 'Thank you for Monthly subscription');
                            return back();
                        }
                    }
                }
                else{
                    $statusMsg = "Subscription activation failed!";
                }
            }
            else{
                $statusMsg = "Subscription creation failed! ".$api_error;
            }
        }
        else{
            $statusMsg = "Subscription creation failed! ".$api_error;
        }
    }

    public function subscriptionPayment(Request $request)
    {
        $currency = "USD";
        $token = $request->id;
        // $paymentMethodID = $request->payment_method;
        $plans = $this->plans();
        $user = auth()->user();
        $planID =1;   // $_POST['subscr_plan']
        $pakage = Pricing::where('duration',"month")->first();
        $pakage->price = $this->percentage($pakage->discount,$pakage->price);
        $planInfo = $plans[$planID];
        $planName = $pakage->duration.'month Subscription';
        $planPrice = $pakage->price;
        $planInterval = $pakage->duration;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            if (is_null($user->stripe_id)) {
                $customer = $user->createAsStripeCustomer();
                $user->addPaymentMethod($token);
            $user->updateDefaultPaymentMethod($token);
            }else {
                $customer = $user->asStripeCustomer();
            }
        }
        catch(Exception $e) {
            dd("failed customer  created");
            $api_error = $e->getMessage();
        }

        if(empty($api_error) && $customer){
            // Convert price to cents
            $priceCents = round($planPrice*100);
            // Create a plan
            try {
                $plan = \Stripe\Plan::create(array(
                    "product" => [
                        "name" => $planName
                    ],
                    "amount" => $priceCents,
                    "currency" => $currency,
                    "interval" => $planInterval,
                    "interval_count" => 1
                ));
            }
            catch(Exception $e) {
                $api_error = $e->getMessage();
            }
            if(empty($api_error) && $plan){
                // Creates a new subscription
                try {
                    $subscription = \Stripe\Subscription::create(array(
                        "customer" => $customer->id,
                        "items" => array(
                            array(
                                "plan" => $plan->id,
                            ),
                        ),
                    ));
                }catch(Exception $e) {
                    $api_error = $e->getMessage();
                }
                if(empty($api_error) && $subscription){
                    // Retrieve subscription data
                    $subsData = $subscription->jsonSerialize();
                    // Check whether the subscription activation is successful
                    if($subsData['status'] == 'active'){
                        // Subscription info
                        $planresponse = array(
                            'user_id'=> $user->id,
                            'stripe_subscription_id'=>$subsData['id'],
                            'stripe_customer_id'=>$subsData['customer'],
                            'stripe_plan_id'=>$subsData['plan']['id'],
                            'plan_amount'=>($subsData['plan']['amount']/100),
                            'plan_amount_currency'=>$subsData['plan']['currency'],
                            'plan_interval'=> $subsData['plan']['interval'],
                            'plan_interval_count'=>$subsData['plan']['interval_count'],
                            'payer_email'=>$this->data['user']['email'],
                            'created'=>date("Y-m-d H:i:s", $subsData['created']),
                            'plan_period_start'=>date("Y-m-d H:i:s", $subsData['current_period_start']),
                            'plan_period_end'=>date("Y-m-d H:i:s", $subsData['current_period_end']),
                            'status'=>$subsData['status']
                        );
                        $response = UserSubscription::insert($planresponse);
                        if($response){
                            $request->session()->flash('subscription', 'Thank you for Monthly subscription');
                            return back();
                        }
                    }
                }
                else{
                    $statusMsg = "Subscription activation failed!";
                }
            }
            else{
                $statusMsg = "Subscription creation failed! ".$api_error;
            }
        }
        else{
            $statusMsg = "Subscription creation failed! ".$api_error;
        }
    }

    /**
     * Adds a payment method to the current user.
     *
     * @param Request $request The request data from the user.
    */
    public function postPaymentMethods( Request $request )
    {
        $user = $request->user();
        $paymentMethodID = $request->get('payment_method');
        if( $user->stripe_id == null ){
            $user->createAsStripeCustomer();
        }
        $user->addPaymentMethod( $paymentMethodID );
        $user->updateDefaultPaymentMethod( $paymentMethodID );
        return response()->json( null, 204 );
    }

    /**
     * Updates a subscription for the user
     *
     * @param Request $request The request containing subscription update info.
     */
    public function updateSubscription( Request $request ){
        $request->validate([
            'payment' => ['required', 'string', 'max:255'],
            'quantity' => 'required',
        ]);
        try{
            $user = auth()->user();
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            //if schedule is already there then cancel that schedule
            if(isset($user->getStripeSubscriptionSchedule)) {
                $schedule = Stripe\SubscriptionSchedule::retrieve($user->getStripeSubscriptionSchedule->subscription_schedule_id);
                $schedule->cancel();
                $user->getStripeSubscriptionSchedule->delete();
            }
            $quantity = $request->quantity;
            $paymentID = $request->get('payment');
            $priceId = $request->get('plan_id');

            $user->updateDefaultPaymentMethod( $paymentID );
            if( !$user->subscribed('Typeskip.ai') ){
                if($request->get('promocode')){
                    $user->newSubscription( 'Typeskip.ai',$priceId)->withCoupon($request->get('promocode'))->trialDays(7)->create( $paymentID );
                }else
                    $user->newSubscription( 'Typeskip.ai',$priceId)->trialDays(7)->create( $paymentID );
            }else{
                $user_subscription = $user->subscription( 'Typeskip.ai');
                $meta_data = Stripe\Subscription::retrieve($user_subscription->stripe_id);
                $current_stripe_quantity = $meta_data->plan->transform_usage->divide_by;
                if($current_stripe_quantity > $quantity){
                    // if downgrade
                    $customer = $user->stripe_id;
                    //cycle end pa charge
                    if($request->get('promocode')){
//                        $user->subscription('Typeskip.ai',[
//                            'prorate' => false,
//                            'proration_behavior' => 'none',
//                        ])->withCoupon($request->get('promocode'))->skipTrial()->noProrate()->swap($priceId); //cycle end pa charge
                        $schedule = \Stripe\SubscriptionSchedule::create([
                            'customer' => $customer,
                            'start_date' => $meta_data->current_period_end,
                            'end_behavior' => 'release',
                            'phases' => [
                                [
                                    'items' => [
                                        [
                                            'price' => $priceId,
                                            'quantity' => $quantity,
                                        ],
                                    ],
                                    'coupon' => $request->get('promocode'),
                                ],
                            ],
                        ]);
                    }else{
                        $schedule = \Stripe\SubscriptionSchedule::create([
                            'customer' => $customer,
                            'start_date' => $meta_data->current_period_end,
                            'end_behavior' => 'release',
                            'phases' => [
                                [
                                    'items' => [
                                        [
                                            'price' => $priceId,
                                            'quantity' => $quantity,
                                        ],
                                    ],
                                ],
                            ],
                        ]);
                    }
                    StripeSubscriptionSchedule::create([
                        'user_id' => $user->id,
                        'subscription_schedule_id' => $schedule->id,
                    ]);
                }else{
                    if($request->get('promocode')) {
                        // else on upgrade
                        $user->subscription('Typeskip.ai',[
                            'prorate' => false,
                            'proration_behavior' => 'none',
                        ])->withCoupon($request->get('promocode'))->skipTrial()->noProrate()->swapAndInvoice($priceId); //instant charge

                    }else{
                        // else on upgrade
                        $user->subscription('Typeskip.ai',[
                            'prorate' => false,
                            'proration_behavior' => 'none',
                        ])->noProrate()->skipTrial()->swapAndInvoice($priceId); //instant charge
                    }
                }
            }
            if(auth()->user()->new_account){
                User::whereId(auth()->id())->update(['new_account' => 0]);
            }
            return response()->json(['status'=>'success','message'=>'Congratulations! You have successfully subscribed to our package']);
        }
        catch(\Exception $e)
        {
            if($e->getMessage())
                return response()->json(['status'=>'error','message'=>$e->getMessage()]);
            else
                return response()->json(['status'=>'error','message'=>'Something went wrong!']);
        }
    }
}

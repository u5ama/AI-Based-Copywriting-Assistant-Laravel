<?php

namespace App\Http\Controllers;

use App\Models\Trail;
use App\Models\TrailHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\StripeSubscriptionSchedule;
use Inertia\Response;
use Stripe\Exception\ApiErrorException;

class UserBillingController extends Controller
{
    public function buyPlan(){
        $stripeKey = config('app.stripe_key');
        return Inertia::render('Billing/Pricing', compact('stripeKey'));
    }

    /**
     * Show user  billing page
     *
     * @param Request $request
     * @return Response;
     * @throws ApiErrorException
     */
    public function showBillingPage(Request $request)
    {
        // initialize default value
        $paymentMethods         = '';
        $userSubscriptionsPlane = '';
        $invoices = '';
        $upcomingInvoice = '';
        // Fetch authenticate user
        $authUser = Auth::user();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        if ($authUser->stripe_id != '') {
            // get users all payment methode from stripe
            $userPaymentMethods = $authUser->paymentMethods();
            $paymentMethods = $userPaymentMethods->toArray();
            // get users subscription id from stripe
            if ($authUser->subscription('default')) {
                $subscriptionId = $authUser->subscription('default')->stripe_id;
                // get user subscription plane from stripe
                $userSubscriptionsPlane = $stripe->subscriptions->retrieve(
                    $subscriptionId
                );
            }
            $invoices = $authUser->invoices();
            $upcomingInvoice = $authUser->upcomingInvoice();
        }
        // get all pricing plane from stripe
        $allPlans =  $stripe->prices->all(['active' => true, 'type' => 'recurring']);
        $oneTimePlans =  $stripe->prices->all(['active' => true, 'type' => 'one_time'])->first();

        // Fetch trail history
        $trailHistory = TrailHistory::whereUserId($authUser->id)
            ->selectRaw('sum(quantity) as quantity,Date(created_at) as created_date')
            ->whereDate('created_at', '>', Carbon::now()->subDays(7))
            ->groupBy(DB::raw('Date(created_at)'))
            ->get()
            ->toArray();

        $TrailHistorySum = TrailHistory::whereUserId($authUser->id)
            ->selectRaw('sum(quantity) as quantity,trail_type')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('trail_type')
            ->get()
            ->toArray();

        $trail_quantity_index = array_search('trail_quantity', array_column($TrailHistorySum, 'trail_type'));
        $trail_quantity_usage = $trail_quantity_index === false ? 0 : $TrailHistorySum[$trail_quantity_index]['quantity'];
        $start      = Carbon::now()->subDays(7);
        $statsDates = array_map(fn ($day) => $start->copy()->addDays($day)->toDateString(), range(0, 7));

        // prepare data for chart
        $statsWordCounts = [];
        foreach ($statsDates as $date) {
            $find = array_search($date, array_column($trailHistory, 'created_date'));
            if ($find === false){
                $statsWordCounts[] = 0;
            } else{
                $statsWordCounts[] = $trailHistory[$find]['quantity'];
            }
        }
        // Get the stripe publish kay for user card input uses
        $stripeKey = config('app.stripe_key');
        $statsDates = array_map(fn ($day) => $start->copy()->addDays($day)->format('d M'), range(0, 7));
        $userPreference = Auth::user()->upgrade_preference;
        // Return the response to backend
        return Inertia::render('Billing/Index', compact('userPreference','statsDates', 'statsWordCounts', 'stripeKey', 'paymentMethods', 'allPlans', 'userSubscriptionsPlane', 'invoices', 'upcomingInvoice', 'oneTimePlans','trail_quantity_usage'));
    }

    /**
     * Returns the subscriptions the user has saved
     *
     * @param User $user
     * @return array
     */
    public function getUserSubscription(User $user)
    {
        return [];
    }

    // Function for add card to stripe
    public function addCard(Request $request)
    {
        $token  = $request->id;
        $user   = auth()->user();

        // Check if user already have card or not
        if ($user->stripe_id == null) {
            $user->createAsStripeCustomer();
        }
        $user = auth()->user();
        try {
            $user->addPaymentMethod($token);
            $user->updateDefaultPaymentMethod($token);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back();
    }

    // Function for update default card to stripe
    public function updateDefaultCard(Request $request)
    {
        $user = auth()->user();
        $user->updateDefaultPaymentMethod($request->id);
        return redirect()->back();
    }

    // Function for delete card from stripe
    public function deleteCard(Request $request)
    {
        $user   = auth()->user();
        $user->removePaymentMethod($request->id);
        return redirect()->back();
    }

    // Function for create subscription
    public function createSubscription(Request $request)
    {
        $user = auth()->user();
        if ($user->stripe_id != '') {
            $user->newSubscription('default', env('STRIPE_FREE_PLAN'))->add();
            if(auth()->user()->new_account){
                User::whereId(auth()->id())->update(['new_account' => 0]);
            }
            return redirect()->back();
        } else {
            $request->validate([
                "payment_method" => "required",
            ]);
            return redirect()->back();
        }
    }

    // Function for cancel subscription
    public function cancelSubscription(Request $request)
    {
        $user = auth()->user();
        if ($user->stripe_id != '') {
            $user->subscription('default')->cancel();
            return redirect()->back();
        } else {
            $request->validate([
                "payment_method" => "required",
            ]);
            return redirect()->back();
        }
    }

    // Function for upgrade subscription
    public function upgradeSubscription(Request $request)
    {
        $user = auth()->user();
        if ($user->card_brand != '' && $user->card_last_four != '') {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $priceId = $request->newSubscriptionId;
            $request_plan = $stripe->prices->retrieve(
                $priceId,
                []
            );
            //if schedule is already there then cancel that schedule
            if (isset($user->getStripeSubscriptionSchedule)) {
                $schedule = $stripe->subscriptionSchedules->retrieve($user->getStripeSubscriptionSchedule->subscription_schedule_id);
                $schedule->cancel();
                $user->getStripeSubscriptionSchedule->delete();
            }
            $priceId = $request->newSubscriptionId;

            if (!$user->subscribed()) {
                if ($request->get('promoCode')) {
                    return $request->get('promoCode');
                } else {
                    return "dont have promoCode";
                }
            } else {
                $user_subscription = $user->subscription('default');
                $meta_data = $stripe->subscriptions->retrieve($user_subscription->stripe_id);
                $current_stripe_quantity = $meta_data->plan->amount;
                if ($current_stripe_quantity > $request_plan->unit_amount) {
                    // if downgrade
                    $customer = $user->stripe_id;
                    //cycle end pa charge
                    if ($request->get('promoCode')) {
                        $schedule = $stripe->subscriptionSchedules->create([
                            'customer' => $customer,
                            'start_date' => $meta_data->current_period_end,
                            'end_behavior' => 'release',
                            'phases' => [
                                [
                                    'items' => [
                                        [
                                            'price' => $priceId,
                                            'quantity' => 1,
                                        ],
                                    ],
                                    'coupon' => $request->get('promoCode'),
                                ],
                            ],
                        ]);
                    } else {
                        $schedule = $stripe->subscriptionSchedules->create([
                            'customer' => $customer,
                            'start_date' => $meta_data->current_period_end,
                            'end_behavior' => 'release',
                            'phases' => [
                                [
                                    'items' => [
                                        [
                                            'price' => $priceId,
                                            'quantity' => 1,
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

                    if ($user->subscription('default')) {
                        $subscriptionId = $user->subscription('default')->stripe_id;
                        // get user subscription plane from stripe
                        $userSubscriptionsPlane = $stripe->subscriptions->retrieve(
                            $subscriptionId
                        );
                    }
                    $trail_quantity = $userSubscriptionsPlane->plan->transform_usage->divide_by;

                    Trail::where('user_id', $user->id)->update([
                        "payment_status" => 0,
                        "trail_status" => 1,
                        "trail_quantity" => $trail_quantity,
                    ]);

                    if(auth()->user()->new_account){
                        User::whereId(auth()->id())->update(['new_account' => 0]);
                    }

                    return redirect()->back();
                } else {
                    if ($request->get('promoCode')) {
                        // else on upgrade
                        $user->subscription('default', [
                            'prorate' => false,
                            'proration_behavior' => 'none',
                        ])->skipTrial()->noProrate()->swapAndInvoice($priceId, [
                            'coupon' => $request->get('promoCode'),
                        ]);
                        //instant charge
                    } else {
                        // else on upgrade
                        $user->subscription('default', [])->noProrate()->skipTrial()->swapAndInvoice($priceId); //instant charge
                    }
                    if ($user->subscription('default')) {
                        $subscriptionId = $user->subscription('default')->stripe_id;
                        // get user subscription plane from stripe
                        $userSubscriptionsPlane = $stripe->subscriptions->retrieve(
                            $subscriptionId
                        );
                    }
                    $trail_quantity = $userSubscriptionsPlane->plan->transform_usage->divide_by;

                    Trail::where('user_id', $user->id)->update([
                        "payment_status" => 0,
                        "trail_status" => 1,
                        "trail_quantity" => $trail_quantity,
                    ]);

                    if(auth()->user()->new_account){
                        User::whereId(auth()->id())->update(['new_account' => 0]);
                    }
                    return redirect()->back();
                }
            }
        }
        else {
            $request->validate([
                "payment_method" => "required",
            ]);
            return redirect()->back();
        }
    }

    public function updateUpgradePref(Request $request)
    {
        $request->validate([
            "upgradePreference" => "required",
        ]);
        $user = auth()->user();
        $input = ['upgrade_preference' => $request->get('upgradePreference')];
        User::where('id',$user->id)->update($input);
        return redirect()->back();
    }
}

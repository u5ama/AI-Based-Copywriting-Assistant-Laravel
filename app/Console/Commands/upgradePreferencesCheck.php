<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class upgradePreferencesCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade-preferences-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check user preferences upgrade if word count less then limit, and upgrade user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get all users with Trails
        // if trails less the limit and user has valid payment method the called user upgrade_preference
        $users  = User::with('Trail')->whereHas('Trail', function ($q) {
            $q->whereRaw('(trail_quantity + trail_bonus) > 0');
        })->whereHas('subscriptions', function ($q) {
            $q->where('name','=', 'Typeskip.ai');
            $q->whereNull('ends_at');
        })->get();
        foreach ($users as $user){
            \App\Jobs\UpgradePreferenceJob::dispatchNow($user);//->onConnection('sync');
        }
        return 0;
    }
}

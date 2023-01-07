<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserDataMarge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'merge:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Merge user column data.';

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
        $this->info('Merging user data...');
        $users = User::all();
        foreach ($users as $user){
            $user->name = $user->username;
            $user->save();
        }
        return Command::SUCCESS;
    }
}

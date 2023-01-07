<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ContentImproverSeeder::class,
            FacebookAdSeeder::class,
            FacebookVideoScriptSeeder::class,
//            GMBUpdatesSeeder::class,
            GoogleAdSeeder::class,
//            InstagramProductPost::class,
            PASFrameworkSeeder::class,
            ProductDescriptionSeeder::class,
//            TweetStorm::class,
            AIDAPrincipleSeeder::class,
            SentenceExpanderSeeder::class,
            BlogOutlineSeeder::class,
            GreateHeadLines::class,
            PersuasiveBulletSeeder::class,
            MarketingAnglesSeeder::class,
        ]);
    }
}

<?php
namespace JingBh\NCMRank;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class NCMRankServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");

        $this->loadViewsFrom(__DIR__ . "/../views", "ncmrank");

        if ($this->app->runningInConsole())
            Artisan::command("ncmrank:update {user?}", function($user="all") {
                if ($user === "all") {
                    NCMSpider::updateAll();
                } else {
                    $user = NCMSpider::find($user);
                    if (empty($user)) {
                        $this->error("User not found, skipping...");
                    } else NCMSpider::updateData($user);
                }
                $this->info("NCMRank Database has successfully updated.");
            })->describe("Update NCMRank data.");
    }
}

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
            Artisan::command("ncmrank:update {users?*}", function($users=[]) {
                if (empty($users)) {
                    NCMSpider::updateAll();
                } else {
                    foreach ($users as $user_id) {
                        $user = NCMUser::where("id", $user_id)->orWhere("name", $user_id)->first();
                        if (empty($user)) {
                            $this->error("User {$user_id} not found, skipping...");
                        } else NCMSpider::updateData($user);
                    }
                }
                $this->info("NCMRank Database has successfully updated.");
            })->describe("Update NCMRank data.");
    }
}

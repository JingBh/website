<?php
namespace JingBh\AutoZP;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JingBh\AutoZP\Http\Middleware\CheckInvite;

class AutoZPServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__ . "/Http/routes.php");
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
        $this->loadViewsFrom(__DIR__ . "/../resources/views", "autozp");

        Route::middlewareGroup("autozp", [CheckInvite::class]);

        if ($this->app->runningInConsole()) {
            Artisan::command("autozp:invite:generate", function() {
                $code = InviteCode::generate();
                $this->info("Generated code: {$code}");
            })->describe("Generate a new AutoZP invite code.");

            Artisan::command("autozp:invite:disable {code}", function($code) {
                InviteCode::disable($code);
            })->describe("Disable a AutoZP invite code.");

            Artisan::command("autozp:invite:enable {code}", function($code) {
                InviteCode::enable($code);
            })->describe("Enable a AutoZP invite code.");
        }
    }
}

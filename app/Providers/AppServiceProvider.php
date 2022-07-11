<?php

namespace App\Providers;

use App\Clients\Curl\Curl;
use Illuminate\Support\ServiceProvider;
use App\Clients\FinanceRapidApiClientFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind(Curl::class);

        $app->singleton(FinanceRapidApiClientFactory::class, static function () use ($app) {
            $curl = $app->get(Curl::class);
            $baseUrl = config('constants.finance_rapid_api_base_url');

            return new FinanceRapidApiClientFactory($curl, $baseUrl);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

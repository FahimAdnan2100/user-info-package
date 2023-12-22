<?php

namespace Fahim\InfoPackage;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class InfoServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'info');
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register(): void
    {
        $this->publishRegister();
    }

    public function publishRegister()
    {
        $basepath = dirname(__DIR__);
        $arrPublishable = [
            'migrations' => [
                "$basepath/database/migrations" => database_path('migrations'),

            ]

        ];

        foreach($arrPublishable as $group=>$paths){
            $this->publishes($paths,$group);
        }
    }
}

<?php

namespace App\Providers;

use App\Helpers\Translate\MyMemoryTranslate;
use Illuminate\Support\ServiceProvider;

class TranslateProvider extends ServiceProvider
{
    /**
     * Initialize provider when needed
     * @var bool
     */
    //protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // use other loaded providers
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Translate\TranslateContract', function(){
            return new MyMemoryTranslate();
        });

        // get it back by:
        // 1 $translator = $this->app->make('NhdTranslate');
        // 2 $translator = $this->app['NhdTranslate'];
        // 3 public function(TranslateContract $translator)
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Helpers\Translate\TranslateContract'];
    }
}

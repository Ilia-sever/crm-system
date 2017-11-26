<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = explode('/', request()->path());

        $modules = config('settings.including-modules');

        foreach ($modules as $num => $module) {
            $modules[$num] = strtolower($module);
        }

        $current_module = '';

        if (!$path[0]) {

            $current_module = 'home';
        }

        elseif (in_array($path[0], $modules)) {

            $current_module = $path[0]; 
        }

        view()->share('modules',$modules);

        view()->share('module_code',$current_module);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

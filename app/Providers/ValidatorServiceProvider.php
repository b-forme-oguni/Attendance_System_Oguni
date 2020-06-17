<?php

namespace App\Providers;

use App\Performance;
use Illuminate\Validation\Validator;
use App\Http\Validators\FormValidator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
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
        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages) {
            return new FormValidator($translator, $data, $rules, $messages);
        });
    }
}

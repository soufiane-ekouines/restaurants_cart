<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $message = Message::with('userSend')
        ->where('userGet_id',3)
        ->where('read_',false)
        ->limit(3)->get();

        // dd($message);

        view()->share('notif', $message);
    }
}

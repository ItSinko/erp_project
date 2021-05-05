<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Http\ViewComposers\AdminLteComposer;
use App\User;
use Illuminate\Support\Facades\Schema;
use App\digidocu\Document;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Http/helper.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('adminlte.page', AdminLteComposer::class);

        Schema::defaultStringLength(191);
        // requests number
        $numReq = count(User::where('status', false)->get());
        View::share('requests', $numReq);
        // trash noti
        $trash = count(Document::where('isExpire', 2)->get());
        View::share('trashfull', $trash);
    }
}

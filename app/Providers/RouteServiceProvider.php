<?php

namespace App\Providers;

use App\Models\User;
use App\Models\AkunPremium;
use Illuminate\Http\Request;
use App\Models\PermintaanBahanBaku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    public const LOGIN = '/login';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $akun = AkunPremium::all();
        $valid = $akun->where('expired_date', '>', \Carbon\Carbon::now());
        $expired = $akun->where('expired_date', '<', \Carbon\Carbon::now());
        foreach ($valid as $i){
            $user = $i->user;
            User::where('id', $user->id)->update(['is_premium' => true]);
        }
        foreach ($expired as $i){
            $user = $i->user;
            User::where('id', $user->id)->update(['is_premium' => false]);
        }
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
        View::composer("layouts.app", function ($view) {
            $view->with([
                "notifications" => PermintaanBahanBaku::whereHas("KerjaSama", function ($query) {
                    $query->whereSupplierId(Auth::user()->id);
                })->whereTelahDibaca(0)->get()
            ]);
        });
    }
}

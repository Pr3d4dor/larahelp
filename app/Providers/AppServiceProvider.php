<?php

namespace App\Providers;

use App\Http\View\Composers\LayoutComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer(
            'partials.sidebar',
            LayoutComposer::class
        );

        View::composer(
            'index',
            LayoutComposer::class
        );

        Blade::directive('formatDate', function ($date) {
            return "<?php echo ($date)->format('d/m/Y').'  '.($date)->timezone('America/Sao_Paulo')->format('H:i:s'); ?>";
        });

        Schema::defaultStringLength(191);
    }
}

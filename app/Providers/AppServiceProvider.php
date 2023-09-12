<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('checkPermission', function ($expression) {
            return "<?php if (eval('return ' . $expression . ';')) : ?>";
        });

        Blade::directive('endcheckPermission', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('userRole', function ($expression) {
            return "<?php echo userRole($expression); ?>";
        });
    }
}

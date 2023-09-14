<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

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

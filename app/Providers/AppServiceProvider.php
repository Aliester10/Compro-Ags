<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use App\Models\Quotation;
use Illuminate\Support\Facades\View;

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
    public function boot()
    {
        // Mengatasi masalah Vite manifest not found
        if (class_exists('Illuminate\Foundation\Vite')) {
            Blade::directive('vite', function ($expression) {
                // Mengganti directive @vite dengan CSS dan JS dari CDN
                return "<?php echo '
                    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
                    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
                '; ?>";
            });
        }
        
        // Mengatasi jika ada upaya mengakses Vite secara langsung
        if (!file_exists(public_path('build/manifest.json'))) {
            mkdir(public_path('build'), 0755, true);
            file_put_contents(public_path('build/manifest.json'), '{}');
        }

        // Kode yang sudah ada untuk menghitung quotation pending
        view()->composer('*', function ($view) {
            $pendingCount = Quotation::where('status', 'pending')->count();
            $view->with('pendingCount', $pendingCount);
        });
        
        // Mengatasi masalah view not found
        View::addLocation(resource_path('views/auth'));
        
        // Menambahkan alias view jika diperlukan
        if (!View::exists('auth.waiting_verification') && 
            View::exists('auth.distributor_waiting')) {
            View::composer('auth.waiting_verification', function ($view) {
                return View::make('auth.distributor_waiting', $view->getData());
            });
        }
    }
}
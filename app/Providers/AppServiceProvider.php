<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::morphMap([
            'SuperAdmin' => 'App\Models\SuperAdmin',
            'Karyawan' => 'App\Models\Karyawan',
            'Terapis' => 'App\Models\Terapis',
            'Pelanggan' => 'App\Models\Pelanggan',
            // Tambahkan model lain di sini jika diperlukan
        ]);
    }
}
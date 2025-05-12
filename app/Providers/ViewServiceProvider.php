<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Sysconfig;
use App\Models\Socialmedia;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $favicon = asset(Sysconfig::getValue('FAVEICON', 'storage/logos/default.ico'));
            $logo = asset(Sysconfig::getValue('LOGO', 'storage/logos/default.png'));
            $socialLinks = Socialmedia::where('isactive', 'Y')->get();

            $view->with([
                'faveicon'      => $favicon,
                'logo'          => $logo,
                'socialLinks'   => $socialLinks,
            ]);
        });
    }
}

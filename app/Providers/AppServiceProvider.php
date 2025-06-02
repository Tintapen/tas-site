<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use App\Models\MailSetting;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Models\Sysconfig;
use Illuminate\Pagination\Paginator;

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
        $this->setAppTimezone();
        $this->registerFilamentNavigation();
        $this->configureMailSettings();
        Paginator::useBootstrapFive();
    }

    protected function setAppTimezone(): void
    {
        $timeZone = Sysconfig::getValue('TIMEZONE', 'UTC') ?: 'UTC';

        date_default_timezone_set($timeZone);
        Config::set('app.timezone', $timeZone);
    }

    protected function registerFilamentNavigation(): void
    {
        Filament::serving(function () {
            $menus = Menu::with(['children' => fn ($query) => $query->where('isactive', 'Y')->orderBy('sort')])
                ->where('isactive', 'Y')
                ->whereNull('parent_id')
                ->orderBy('sort')
                ->get();

            $groups = [];
            $items = [];

            foreach ($menus as $menu) {
                if ($menu->children->isNotEmpty()) {
                    $groups[] = NavigationGroup::make()
                        ->label($menu->label)
                        ->icon($menu->icon ?? 'heroicon-o-folder')
                        ->collapsed();

                    foreach ($menu->children as $child) {
                        $items[] = NavigationItem::make()
                            ->label($child->label)
                            ->url(fn () => url($child->url))
                            ->group($menu->label)
                            ->sort($child->sort)
                            ->isActiveWhen(fn () => request()->is(trim(parse_url($child->url, PHP_URL_PATH), '/')));
                    }
                } else {
                    $items[] = NavigationItem::make()
                        ->label($menu->label)
                        ->icon($menu->icon ?? 'heroicon-o-document-text')
                        ->url(fn () => url($menu->url))
                        ->sort($menu->sort)
                        ->isActiveWhen(fn () => request()->is(trim(parse_url($menu->url, PHP_URL_PATH), '/')));
                }
            }

            Filament::registerNavigationGroups($groups);
            Filament::registerNavigationItems($items);
        });
    }

    protected function configureMailSettings(): void
    {
        if (!Schema::hasTable('mail_settings')) {
            return;
        }

        $mail = MailSetting::first();

        if (!$mail) {
            return;
        }

        config([
            'mail.default' => $mail->mailer,
            'mail.mailers.smtp.host' => $mail->host,
            'mail.mailers.smtp.port' => $mail->port,
            'mail.mailers.smtp.username' => $mail->username,
            'mail.mailers.smtp.password' => $mail->password,
            'mail.mailers.smtp.encryption' => $mail->encryption,
            'mail.from.address' => $mail->from_address,
            'mail.from.name' => $mail->from_name,
        ]);
    }
}

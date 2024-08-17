<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
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
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);

        Gate::define('add_categories', function (Admin $admin) {
            return $admin->hasAnyPermission('add_categories');
        });
        Gate::define('update_categories', function (Admin $admin) {
            return $admin->hasAnyPermission('update_categories');
        });
        Gate::define('delete_categories', function (Admin $admin) {
            return $admin->hasAnyPermission('delete_categories');
        });
        Gate::define('show_categories', function (Admin $admin) {
            return $admin->hasAnyPermission('show_categories');
        });
        // Gate::define('add_items', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_items');
        // });
        // Gate::define('update_items', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_items');
        // });
        // Gate::define('delete_items', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_items');
        // });
        // Gate::define('show_items', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_items');
        // });
        // Gate::define('add_orders', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_orders');
        // });
        // Gate::define('update_orders', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_orders');
        // });
        // Gate::define('delete_orders', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_orders');
        // });
        // Gate::define('show_orders', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_orders');
        // });
        // Gate::define('add_users', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_users');
        // });
        // Gate::define('update_users', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_users');
        // });
        // Gate::define('delete_users', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_users');
        // });
        // Gate::define('show_users', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_users');
        // });
        // Gate::define('add_roles', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_roles');
        // });
        // Gate::define('update_roles', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_roles');
        // });
        // Gate::define('delete_roles', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_roles');
        // });
        // Gate::define('show_roles', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_roles');
        // });
        // Gate::define('add_permissions', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_permissions');
        // });
        // Gate::define('update_permissions', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_permissions');
        // });
        // Gate::define('delete_permissions', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_permissions');
        // });
        // Gate::define('show_permissions', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_permissions');
        // });
        // Gate::define('view_dashboard', function (Admin $admin) {
        //     return $admin->hasAnyPermission('view_dashboard');
        // });
        // Gate::define('manage_settings', function (Admin $admin) {
        //     return $admin->hasAnyPermission('manage_settings');
        // });
        // Gate::define('add_countries', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_countries');
        // });
        // Gate::define('update_countries', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_countries');
        // });
        // Gate::define('delete_countries', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_countries');
        // });
        // Gate::define('show_countries', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_countries');
        // });
        // Gate::define('add_ciities', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_ciities');
        // });
        // Gate::define('update_ciities', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_ciities');
        // });
        // Gate::define('delete_ciities', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_ciities');
        // });
        // Gate::define('show_ciities', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_ciities');
        // });
        // Gate::define('add_currencies', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_currencies');
        // });
        // Gate::define('update_currencies', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_currencies');
        // });
        // Gate::define('delete_currencies', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_currencies');
        // });
        // Gate::define('show_currencies', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_currencies');
        // });
        // Gate::define('add_admins', function (Admin $admin) {
        //     return $admin->hasAnyPermission('add_admins');
        // });
        // Gate::define('update_admins', function (Admin $admin) {
        //     return $admin->hasAnyPermission('update_admins');
        // });
        // Gate::define('delete_admins', function (Admin $admin) {
        //     return $admin->hasAnyPermission('delete_admins');
        // });
        // Gate::define('show_admins', function (Admin $admin) {
        //     return $admin->hasAnyPermission('show_admins');
        // });



    }
}

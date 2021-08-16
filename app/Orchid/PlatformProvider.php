<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;


class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [


            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Dashboard')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
            Menu::make('Email sender')
                ->icon('envelope-letter')
                ->route('platform.email'),
            Menu::make('store codes ')
                ->icon('docs')
                ->route('platform.storecode.list'),
            Menu::make('aid requests')
                ->icon('docs')
                ->route('platform.aidrequests.List'),
            Menu::make('aid requests history')
                ->icon('docs')
                ->route('platform.aidrequestshistory.List'),
            Menu::make('add points ')
                ->icon('docs')
                ->route('platform.addpoints.list'),
             Menu::make('pricing')
                 ->icon('docs')
                 ->route('platform.pricing.list'),
            Menu::make('website info')
                ->icon('docs')
                ->route('platform.websiteinfo.edit')
        ];

    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }




}

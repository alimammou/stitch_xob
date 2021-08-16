<?php

namespace App\Orchid\Layouts;

use App\Models\aidrequest;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class aidrequestsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'requests';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('User_id','user name')
                ->render(function ($model) {
                    return $model->User->name;
                }),
            TD::make('name', 'Developer name')
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (aidrequest $user) {
                    return ModalToggle::make($user->name)
                        ->modal('onesyncModal')
                        ->method('saveUser')
                        ->asyncParameters([
                            'user' => $user->id,
                        ]);
                }),

            TD::make('website', 'website'),
            TD::make('socialmedia', 'social media link'),
            TD::make('gameplay', 'gameplay footage'),
            TD::make('pointsgiven', 'points given'),
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),

        ];
    }
}

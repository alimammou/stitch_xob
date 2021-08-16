<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Platform\Models\Role;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
            Input::make('user.points')
                ->type('number')
                ->title(__('dev points'))
                ->placeholder(__('points')),
            Input::make('user.tester_points')
                ->type('number')
                ->title(__('tester points'))
                ->placeholder(__('tester_points')),
            CheckBox::make('user.shadow_ban')
                ->title(__('shadow ban'))
                ->sendTrueOrFalse()
                ->placeholder(__('shadow_ban')),
            CheckBox::make('user.ban')
                ->title(__('ban'))
                ->sendTrueOrFalse()
                ->placeholder(__('ban')),
            Select::make('user.role')
                ->options(['1'=>'tester','2'=>'dev'])

                ->title(__('role'))
                ->help('Specify which groups this account should belong to')
                ->empty(),
        ];
    }
}

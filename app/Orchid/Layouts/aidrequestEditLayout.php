<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Platform\Models\Role;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class aidrequestEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.user_id')
                ->title("id")
                ->value(__('user_id')),
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->title("developer name")
                ->placeholder(__('Name')),

            Input::make('user.website')
                ->title(__('website'))
                ->placeholder(__('website')),
            Input::make('user.socialmedia')
                ->type('number')
                ->title(__('social media link'))
                ->placeholder(__('socialmedia')),
            Input::make('user.gameplay')
                ->title(__('gameplay footage'))
                ->placeholder(__('gameplay')),
            Input::make('user.playersnum')
                ->type('number')
                ->title(__('how many testers?'))
                ->placeholder(__('playersnum')),
            Input::make('user.pointsgiven')
                ->type('number')
                ->required()
                ->title(__('points to give'))
                ->placeholder(__('pointsgiven')),

        ];
    }
}

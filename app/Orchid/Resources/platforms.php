<?php

namespace App\Orchid\Resources;

use App\Models\platform;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;

class platforms extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = platform::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('name')
                ->placeholder('Enter name here'),
            Input::make('class')
                ->title('class')
                ->placeholder('Enter class here'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),

            TD::make('name'),
            TD::make('class'),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('name'),
            Sight::make('class'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }
    public function onDelete(Model $model)
    {
        Alert::info('you cant delete platforms');
    }
}

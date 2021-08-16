<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class storepointsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'add points ';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'add points for a user';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('add ')
            ->icon('plus')
            ->method('add')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
            Relation::make('id')
                ->fromModel(User::class, 'name')
                ->title('user'),
            Input::make('number')
                ->type('number')
                ->title('points')
            ])
        ];
    }
    public function add(Request $request)
    {
        $x=User::findorfail( $request->id);
        $x->points=$x->points+$request->number;
        $x->save();

        Alert::info('You have successfully add points for this User');

    }
}

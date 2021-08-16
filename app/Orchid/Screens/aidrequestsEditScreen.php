<?php

namespace App\Orchid\Screens;

use App\Models\aidrequest;
use App\Models\storeitem;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class aidrequestsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'aidrequestsEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'aidrequestsEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(aidrequest $code): array
    {
        $this->exists = $code->exists;

        if($this->exists){
            $this->name = 'Edit code';
        }

        return [
            'storecode' => $code
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create ')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),


            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
                Input::make('id')
                   ->disabled()
                   ->placeholder($id),

            ])
        ];
    }
}

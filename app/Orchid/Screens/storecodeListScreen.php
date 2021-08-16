<?php

namespace App\Orchid\Screens;

use App\Models\storecode;
use App\Orchid\Filters\gameFilter;
use App\Orchid\Layouts\storecodeListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
class storecodeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'store codes ';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'view all store codes';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'codes' => storecode::with('storeitem')->paginate()
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.storecode.edit')
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
            //  \App\Orchid\Layouts\gamefilter::class,
            storecodeListLayout::class
        ];
    }

}

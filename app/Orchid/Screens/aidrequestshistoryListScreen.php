<?php

namespace App\Orchid\Screens;

use App\Models\aidrequest;
use App\Orchid\Layouts\aidrequestEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class aidrequestshistoryListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'aid requests';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'aid requests';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $requests=aidrequest::query()->whereNotNull('pointsgiven')->paginate();
        return [
            'requests' =>$requests
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {

        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            \App\Orchid\Layouts\aidrequestsListLayout::class,

        ];
    }

}

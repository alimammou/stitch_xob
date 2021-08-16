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

class aidrequestsListScreen extends Screen
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
        $requests=aidrequest::query()->where('pointsgiven',null)->paginate();
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
            Layout::modal('onesyncModal', aidrequestEditLayout::class)
                ->async('asyncGetdata'),
        ];
    }
    public function asyncGetdata(aidrequest $user): array
    {
        return [
            'user' => $user,
        ];
    }
    public function saveUser( \Illuminate\Http\Request $request): void
    {
        $rrequest=$request->user;
        //ddd($rrequest);
        $r=aidrequest::where('user_id',$rrequest['user_id'])->latest()->first();
        if($r->pointsgiven!=null)
            return;
        $r->pointsgiven=$rrequest['pointsgiven'];
        $r->save();
        $u=\App\Models\User::find($rrequest['user_id']);
        $u->points=$u->points+$rrequest['pointsgiven'];
        $u->save();
    }
}

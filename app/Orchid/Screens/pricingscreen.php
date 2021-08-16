<?php

namespace App\Orchid\Screens;

use App\Models\price;
use App\Models\storeitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class pricingscreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit prices';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'pricingscreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(price $p): array
    {
        $x=$p->latest()->first();
        if($x) {
            return [
                'p' => $x->get()
            ];
        }
        else
        {
            $p=price::create([
                'points_price'=>'1',
                'rate'=>'1'
            ]);
            return [
                'p'=>$p
            ];
        }
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('update prices ')
                ->icon('pencil')
                ->method('createOrUpdate'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        $x=price::latest()->first();
        return [
            Layout::rows([
                Input::make('points_price')
                    ->type('number')
                    ->max(1)
                    ->min(0.1)
                    ->value($x->points_price)
                    ->step(0.1)
                    ->required()
                    ->title('Points pricing for developers (1 Point = $X)'),
                Input::make('rate')
                    ->type('number')
                    ->required()
                    ->max(3)
                    ->min(1)
                    ->value($x->rate)
                    ->step(0.1)
                    ->title('premium rate for store games'),
            ])
        ];
    }
    public function createOrUpdate( Request $request)
    {
        $request->validate(
            [
                'points_price'=>'required',
                'rate'=>'required'
            ]
        );

           price::latest()->first()->update(
               [
                   'points_price'=>$request->points_price,
                   'rate'=>$request->rate
               ]
           );
        Alert::info('You have successfully updated the pricing.');
        return redirect()->route('platform.pricing.list');
       }


}

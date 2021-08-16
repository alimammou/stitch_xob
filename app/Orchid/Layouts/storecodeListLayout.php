<?php
namespace App\Orchid\Layouts;

use App\Models\storecode;
use App\Orchid\Filters\QueryFilter;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class storecodeListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'codes';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('storeitem_id','game')
                ->render(function ($model) {
                    return $model->storeitem->title;
                })
                ->filter(TD::FILTER_TEXT),
            TD::make('code', 'code')
                ->render(function (storecode $post) {
                    return Link::make($post->code)
                        ->route('platform.storecode.edit', $post);
                }),
            TD::make('ispurchased','purchased?')
                ->render(function (storecode $post) {
                    if($post->ispurchased==0)
                        return 'no';
                    else
                        return 'yes';
                }),
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),

        ];
    }

}

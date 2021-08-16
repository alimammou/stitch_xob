<?php

namespace App\Orchid\Filters;

use App\Models\storeitem;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
class gameFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['name'];

    /**
     * @return string
     */
    public function name(): string
    {
        return '';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {   if ($this->request->has('name'))
    {
    $c = storeitem::where('title', $this->request->get('name'))->first();
        return $builder->where('storeitem_id', $c->id);
    }
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Input::make('name')
                ->type('text')
                ->value($this->request->get('name'))
                ->placeholder('Search...')
                ->title('Search')
        ];
    }
}

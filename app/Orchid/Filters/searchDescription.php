<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;


class searchDescription extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['description'];

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
    {
        return $builder->where('description', $this->request->get('description'));

    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Input::make('description')
                ->type('text')
                ->value($this->request->get('description'))
                ->placeholder('Search...')
                ->title('Search by description')
        ];
    }
}

<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;


class QueryFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['title','description'];

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
        if ($this->request->has('title','description'))
            return $builder->where('title', $this->request->get('title'))->where('description', $this->request->get('description'));

        elseif ($this->request->has('description'))
            return $builder->where('description', $this->request->get('description'));
        else
        return $builder->where('title', $this->request->get('title')) ;

    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Input::make('title')
                ->type('text')
                ->value($this->request->get('title'))
                ->placeholder('Search...')
                ->title('Search by title'),
            Input::make('description')
                ->type('text')
                ->value($this->request->get('description'))
                ->placeholder('Search...')
                ->title('Search by description')
        ];
    }
}

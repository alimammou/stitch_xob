<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class RoleFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'id',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('id');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('id', $this->request->get('id'));
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Select::make('id')
                ->fromModel(User::class,'name')
                ->empty()
                ->value($this->request->get('name'))
                ->title(__('search by name')),
        ];
    }

    /**
     * @return string
     */

}

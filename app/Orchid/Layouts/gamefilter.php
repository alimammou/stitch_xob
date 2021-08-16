<?php

namespace App\Orchid\Layouts;

use App\Orchid\Filters\QueryFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class gamefilter extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [\App\Orchid\Filters\gameFilter::class];
    }
}

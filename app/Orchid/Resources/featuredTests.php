<?php

namespace App\Orchid\Resources;

use App\Models\featuredTest;
use App\Models\tests;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;

class featuredTests extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = featuredTest::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('test_id')
                ->fromModel(tests::class, 'title')
                ->title('title')
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('tests_id','tests')
                ->render(function ($model) {
                    return $model->test->title;
                }),

        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('tests_id','tests')
                ->render(function ($model) {
                    return $model->test->title;
                }),
            Sight::make('tests_id','thumbnail ')
                ->render(function ($model) {
                    $x=$model->test->pathtothumbnail;
                    return "<img src=$x
                    class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('tests_id','description')
                ->render(function ($model) {
                    return $model->test->description;
                }),
            Sight::make('tests_id','genres')
                ->render(function ($model) {
                    return $model->test->genres;
                }),
            Sight::make('tests_id','platform')
                ->render(function ($model) {
                    return $model->test->platform;
                }),

        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }
    public function with(): array
    {
        return ['test'];
    }

}

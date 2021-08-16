<?php

namespace App\Orchid\Resources;

use App\Models\storeitem;
use App\Models\tests;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class featuredStoreItems extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\featuredStoreitems::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('storeitems_id')
                ->fromModel(storeitem::class, 'title')
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
            TD::make('id'),
            TD::make('storeitems_id','title ')
                ->render(function ($model) {
                    return $model->storeitems->title;
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
            Sight::make('storeitems_id','title ')
                ->render(function ($model) {
                    return $model->storeitems->title;
                }),
            Sight::make('storeitems_id','thumbnail ')
                ->render(function ($model) {
                    $x=$model->storeitems->pathtothumbnail;
                    return "<img src=$x
                    class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('storeitems_id','developer ')
                ->render(function ($model) {
                    return $model->storeitems->developer;
                }),
            Sight::make('storeitems_id','publisher ')
                ->render(function ($model) {
                    return $model->storeitems->publisher;
                }),
            Sight::make('storeitems_id','description ')
                ->render(function ($model) {
                    return $model->storeitems->description;
                }),
            Sight::make('storeitems_id','genres ')
                ->render(function ($model) {
                    return $model->storeitems->genres;
                }),
            Sight::make('storeitems_id','platform ')
                ->render(function ($model) {
                    return $model->storeitems->platform;
                }),
            Sight::make('storeitems_id','price ')
                ->render(function ($model) {
                    return $model->storeitems->price;
                }),
            Sight::make('storeitems_id','redeemable on ')
                ->render(function ($model) {
                    return $model->storeitems->redeemableon;
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
        return ['storeitems'];
    }
}

<?php

namespace App\Orchid\Resources;

use App\Models\genre;
use App\Models\platform;
use App\Models\price;
use http\Client\Request;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;
use App\Models\storeitem;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Sight;
use App\Orchid\Filters\QueryFilter;
use App\Orchid\Filters\searchDescription;

class StoreitemResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = storeitem::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('title')
                ->title('Title')
                ->required()
                ->placeholder('Enter title here'),
            TextArea::make('description')
                ->title('description')
                ->required()
                ->placeholder('Enter description here'),
            Input::make('developer')
                ->title('developer')
                ->required()
                ->placeholder('developer '),
            Input::make('publisher')
                ->title('publisher')
                ->required()
                ->placeholder('publisher'),
            Select::make('genres.')
                ->fromModel(genre::class,'name','name')
                ->multiple()
                ->required()
                ->title('genres'),
            Input::make('trailer')
                ->title('trailer')
                ->required()
                ->placeholder('trailer'),
            Input::make('price')
                ->title('Price (In USD)')
                ->required()
                ->placeholder('price'),
            Relation::make('platforms_id')
                ->fromModel(platform::class, 'name')
                ->required()
                ->title('Platform'),
            Input::make('redeemableon')
                ->title('redeemable on')
                ->required()
                ->placeholder('reedemable on'),
            Picture::make('pathtothumbnail')
                ->targetRelativeUrl()
                ->required()
                ->title('thumbnail'),
            Picture::make('pathtosc1')
                ->targetRelativeUrl()
                ->title('sc1'),
            Picture::make('pathtosc2')
                ->targetRelativeUrl()
                ->title('sc2'),
            Picture::make('pathtosc3')
                ->targetRelativeUrl()
                ->title('sc3'),
            Picture::make('pathtosc4')
                ->targetRelativeUrl()
                ->title('sc4'),
            Picture::make('pathtosc5')
                ->targetRelativeUrl()
                ->title('sc5'),
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
            TD::make('pathtothumbnail', 'ID')
                ->width('150px')
                ->render(function (storeitem $model) {
                    return "<img src=$model->pathtothumbnail
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'>$model->id</span>";
                }),
            TD::make('title')->sort(),
            TD::make('developer')->sort(),
            TD::make('publisher')->sort(),
            TD::make('description')->sort(),
            TD::make('genres'),
            TD::make('platforms_id','platform ')
                ->render(function ($model) {
                    return $model->platform->name;
                }),
            TD::make('price','Price (In USD)')
                ->render(function ($model) {
                    $x=price::latest()->first();
                    return $model->price.'('.$x->rate*$model->price*10 .' points)';
                }),
            TD::make('num','left in stock'),
            TD::make('redeemableon','redeemable on'),
            TD::make('created_at', 'Date of creation')->sort()
                ->defaultHidden()
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')->sort()
                ->defaultHidden()
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
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
            Sight::make('id'),
            Sight::make('pathtothumbnail','thumbnail')
                ->render(function (storeitem $model) {
                    return "<img src=$model->pathtothumbnail
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('title'),
            Sight::make('developer'),
            Sight::make('publisher'),
            Sight::make('description'),
            Sight::make('genres'),
            Sight::make('platforms_id','platform ')
                ->render(function ($model) {
                    return $model->Platform->name;
                }),
            Sight::make('price','Price (In USD)'),
            Sight::make('redeemableon','redeemable on'),
            Sight::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
            Sight::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
            Sight::make('pathtosc1','sc1')
                ->render(function (storeitem $model) {
                    return "<img src=$model->pathtosc1
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc2','sc2')
                ->render(function (storeitem $model) {
                    return "<img src=$model->pathtosc2
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc3','sc3')
                ->render(function (storeitem $model) {
                    return "<img src=$model->pathtosc3
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc4','sc4')
                ->render(function (storeitem $model) {
                    return "<img src=$model->pathtosc4
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc5','sc5')
                ->render(function (storeitem $model) {
                    return "<img src=$model->pathtosc5
                              class='mw-100 d-block img-fluid'>";
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
        return [
            QueryFilter::class
        ];
    }
    public static function perPage(): int
    {
        return 30;
    }
    public function with(): array
    {
        return ['platform'];
    }

}

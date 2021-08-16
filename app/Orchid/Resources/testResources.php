<?php

namespace App\Orchid\Resources;

use App\Models\featuredTest;
use App\Models\genre;
use App\Models\platform;
use http\Client\Request;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;
use App\Models\tests;
use App\Models\User;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use App\Orchid\Filters\QueryFilter;
use App\Orchid\Actions\addcodes;
use Orchid\Support\Facades\Alert;

class testResources extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = tests::class;

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
                ->placeholder('Enter title here'),
            Relation::make('user_id')
                ->fromModel(User::class, 'name')
                ->title('user'),
            TextArea::make('description')
                ->title('description')
                ->placeholder('Enter description here'),
            Select::make('genres.')
                ->fromModel(genre::class,'name','name')
                ->multiple()
                ->title('genres'),
            Input::make('trailer')
                ->title('trailer')
                ->placeholder('trailer'),
            Input::make('rewardpool')
                ->title('rewardpool')
                ->placeholder('rewardpool'),
            Input::make('remaining_points')
                ->title('rewardpool')
                ->placeholder('rewardpool'),
            Select::make('page_status')
                ->title('page status')
                ->options(['published' =>' published', 'Draft' =>'Draft']),
            Select::make('test_status')
                ->title('test status')
                ->options(['On-going' =>'On-going','Complete' => 'Complete']),
            Relation::make('platforms_id')
                ->fromModel(platform::class, 'name')
                ->title('Platform'),
            Select::make('tester_registration')
                ->options([
                    'Disabled' => 'Disabled',
                    'Enabled' => 'Enabled',
                ])
                ->title('Tester Registration'),
            Select::make('Version')
                ->title('Test Version')
                ->options([ 'Prototype' => 'Prototype', 'Pre-Alpha' =>  'Pre-Alpha', 'Alpha' =>  'Alpha', 'Pre-Beta' =>  'Pre-Beta', 'Beta' =>  'Beta', 'Released' =>  'Released']),
            Picture::make('pathtothumbnail')
                ->targetRelativeUrl()
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
                ->width('150')
                ->render(function (tests $model) {
                    return "<img src=$model->pathtothumbnail
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'>$model->id</span>";
                }),
            TD::make('title')->sort(),
            TD::make('user_id','user ')
                ->render(function ($model) {
                    return $model->User->name;
                }),
            TD::make('description'),
            TD::make('genres'),
            TD::make('platforms_id','platform ')
                ->render(function ($model) {
                    return $model->platform->name;
                }),
            TD::make('created_at', 'Date of creation')->sort()
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')->sort()
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
            Sight::make('pathtothumbnail', 'thumbnail')
                ->render(function (tests $model) {
                    return "<img src=$model->pathtothumbnail
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('title'),
            Sight::make('description'),
            Sight::make('genres'),
            Sight::make('platforms_id','platform ')
                ->render(function ($model) {
                    return $model->Platform->name;
                }),
            Sight::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
            Sight::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
            Sight::make('pathtosc1', 'sc1')
                ->render(function (tests $model) {
                    return "<img src=$model->pathtosc1
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc2', 'sc2')
                ->render(function (tests $model) {
                    return "<img src=$model->pathtosc2
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc3', 'sc3')
                ->render(function (tests $model) {
                    return "<img src=$model->pathtosc3
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc4', 'sc4')
                ->render(function (tests $model) {
                    return "<img src=$model->pathtosc4
                              class='mw-100 d-block img-fluid'>";
                }),
            Sight::make('pathtosc5', 'sc5')
                ->render(function (tests $model) {
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
        return ['user','platform'];
    }

    public function onDelete(Model $model)
    {
       $tests=featuredTest::where('tests_id',$model->id);
       foreach ($tests as $test)
       {
           $tests->delete();
       }
       $model->delete();
    }
}

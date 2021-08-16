<?php

namespace App\Orchid\Screens;

use App\Models\aboutpage;
use App\Models\price;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class websiteinfo extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'website info';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'website info';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(aboutpage $info): array
    {
        $x=$info->latest()->first();
        if($x) {
            return [
                'p' => $x->get()
            ];
        }
        else
        {
            $p=aboutpage::create([
                'faq'=>' <div class="card dFAQCard">
                        <div class="card-header dFAQCHead" role="tab">
                            <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-1" href="#accordion-1 .item-1" class="dFAQCHHBtn">Question</a></h5>
                        </div>
                        <div class="collapse item-1 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <p class="card-text dFAQCCPara">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card dFAQCard">
                        <div class="card-header dFAQCHead" role="tab">
                            <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="#accordion-1 .item-2" class="dFAQCHHBtn">Question</a></h5>
                        </div>
                        <div class="collapse item-2 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <p class="card-text dFAQCCPara">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card dFAQCard">
                        <div class="card-header dFAQCHead" role="tab">
                            <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="#accordion-1 .item-3" class="dFAQCHHBtn">Question</a></h5>
                        </div>
                        <div class="collapse item-3 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <p class="card-text dFAQCCPara">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card dFAQCard">
                        <div class="card-header dFAQCHead" role="tab">
                            <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-4" href="#accordion-1 .item-4" class="dFAQCHHBtn">Question</a></h5>
                        </div>
                        <div class="collapse item-4 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <p class="card-text dFAQCCPara">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card dFAQCard">
                        <div class="card-header dFAQCHead" role="tab">
                            <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-5" href="#accordion-1 .item-5" class="dFAQCHHBtn">Question</a></h5>
                        </div>
                        <div class="collapse item-5 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <p class="card-text dFAQCCPara">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                            </div>
                        </div>
                    </div>',
                'presskit'=>'1',
                'privacypolicy'=>'1',
                'tandc'=>'1',
                'legalnotice'=>'1',
                'coockiepolicy'=>'1',

            ]);
            return [
                'p'=>$p
            ];
        }
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('update prices ')
                ->icon('pencil')
                ->method('createOrUpdate'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        $x=aboutpage::latest()->first();
        return [
            Layout::rows([
                TextArea::make('faq')
                    ->type('textarea')
                    ->value($x->faq)
                    ->required()
                    ->title('FAQ'),
                Quill::make('presskit')
                    ->type('text')
                    ->required()
                    ->value($x->presskit)
                    ->title('presskit'),
                Quill::make('privacypolicy')
                    ->type('text')
                    ->required()
                    ->value($x->privacypolicy)
                    ->title('privacypolicy'),
                Quill::make('tandc')
                    ->type('text')
                    ->required()
                    ->value($x->tandc)
                    ->title('terms and conitions'),
                Quill::make('legalnotice')
                    ->type('text')
                    ->required()
                    ->value($x->legalnotice)
                    ->title('legal notice'),
                Quill::make('coockiepolicy')
                    ->type('text')
                    ->required()
                    ->value($x->coockiepolicy)
                    ->title('coockie policy'),
            ])
        ];
    }public function createOrUpdate( Request $request)
{


    aboutpage::latest()->first()->update(
        [
            'coockiepolicy'=>$request->coockiepolicy,
            'legalnotice'=>$request->legalnotice,
            'tandc'=>$request->tandc,
            'privacypolicy'=>$request->privacypolicy,
            'presskit'=>$request->presskit,
            'faq'=>$request->faq,
        ]
    );
    Alert::info('You have successfully updated the website info.');
    return redirect()->route('platform.websiteinfo.edit');
}

}

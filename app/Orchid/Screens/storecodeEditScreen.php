<?php

namespace App\Orchid\Screens;

use App\Models\storecode;
use App\Models\storeitem;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
class storecodeEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'storecodeEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'storecodeEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(storecode $code): array
    {
        $this->exists = $code->exists;

        if($this->exists){
            $this->name = 'Edit code';
        }

        return [
            'storecode' => $code
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create ')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),


            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        /** @var storecode $user */
        return [
            Layout::rows([
                Relation::make('storeitem_id')
                    ->fromModel(storeitem::class, 'title')
                    ->title('game'),
                TextArea::make('code')
                    ->title('codes')
                    ->placeholder('Make sure to seperate each unique key with a new line.'),
            ])
        ];
    }
    public function createOrUpdate( Request $request)
    {
        $request->validate(
            [
                'storeitem_id'=>'required',
                'code'=>['required','unique:storecodes']
            ]
        );
       // return ddd($request->code);
        $c=preg_split("/\r\n|\n|\r/", $request->code);
        $x=storeitem::findorfail($request->storeitem_id);
        foreach( $c as $line) {
            $code=new storecode();
            $code->storeitem_id=$request->storeitem_id;
            $code->code=$line;
            $x->num=$x->num+1;
            $x->save();
            $code->save();
        }
        Alert::info('You have successfully created code.');
        return redirect()->route('platform.storecode.list');
    }
    public function remove(storecode $post)
    {
       $x=$post->storepurchase()->get();
        foreach($x as $z) {
            Alert::info('You cant delete or edit this code its already purchased');

            return redirect()->route('platform.storecode.list');
        }
        $x=storeitem::findorfail($post->storeitem_id);
        $x->num=$x->num-1;
        $x->save();

        $post->delete();

        Alert::info('You have successfully deleted the code.');

        return redirect()->route('platform.storecode.list');
    }
}

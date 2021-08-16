<?php
namespace App\Orchid\Screens;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class EmailSenderScreen extends Screen
{
/**
* Display header name.
*
* @var string
*/
public $name = 'Email sender';

/**
* Display header description.
*
* @var string
*/
public $description = 'Tool that sends ad-hoc email messages.';

/**
* Query data.
*
* @return array
*/
public function query(): array
{
    return [
        'subject',
    ];
}

/**
* Button commands.
*
* @return Link[]
*/
public function commandBar(): array
{
return [
Button::make('Send Message')
->icon('paper-plane')
->method('sendMessage')
];
}

/**
* Views.
*
* @return Layout[]
*/
public function layout(): array
{
return [
Layout::rows([
Input::make('subject')
->title('Subject')
->required()
->placeholder('Message subject line')
->help('Enter the subject line for your message'),

Relation::make('users.')
->title('Recipients')
->multiple()
->placeholder('Email addresses')
->help('Enter the users that you would like to send this message to.')
->fromModel(User::class,'name','email'),
    CheckBox::make('sendall')
        ->title('Recipients')
        ->sendTrueOrFalse()
        ->placeholder(__('Send to all Users')),
    CheckBox::make('sendalldev')
        ->sendTrueOrFalse()
        ->placeholder(__('Send to all developers')),
    CheckBox::make('sendallt')
        ->sendTrueOrFalse()
        ->placeholder(__('Send to all testers'))
        ->help('choose only one'),
Quill::make('content')
->title('Content')
->required()
->placeholder('Insert text here ...')
->help('Add the content for the message that you would like to send.')

])
];
}

/**
* @param Request $request
*
* @return \Illuminate\Http\RedirectResponse
*/
public function sendMessage(Request $request)
{
$request->validate([
'subject' => 'required|min:6|max:50',
'content' => 'required|min:10'
]);
$content=["content"=>$request->get('content')];
Mail::send( 'emails.email',$content , function ($message) use ($request) {

$message->subject($request->get('subject'));
if ($request->get('sendall')==true)
{
    $u=User::all();
    foreach($u as $user) {
        $email = $user->email;
        $message->bcc($email);
    }
}
elseif ($request->get('sendalldev')==true)
{
    $u=User::where('role','2')->get();
    foreach($u as $user) {
        $email = $user->email;
        $message->bcc($email);
    }
}
elseif ($request->get('sendallt')==true)
{
    $u=User::where('role','1')->get();
    foreach($u as $user) {
        $email = $user->email;
        $message->bcc($email);
    }
}
else if($request->get('users') )
{
foreach ($request->get('users') as $email) {
    $message->bcc($email);
}
}
else {
    Alert::info('please add some users.');
    return;
}

});


Alert::info('Your email message has been sent successfully.');
}

}

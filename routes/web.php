<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\linkcontroller;
use \App\Http\Controllers\FormController;
use  \App\Http\Controllers\UserController;
use App\Http\Controllers\testsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $stores=\App\Models\featuredStoreitems::with('storeitems')->get();
    $tests=\App\Models\featuredTest::with('test')->get();
    return view('main1',[
        'stores'=>$stores,
        'tests'=>$tests,
        'price'=>\App\Models\price::latest()->first()]);});
Route::get('/tests', function () {
    $tests=\App\Models\tests::with('platform');
    $tests->Ffilters(request(['search','platform','genre','reward','order']));
    return view('test1',
    ['tests'=>$tests->where('page_status','1')->paginate(12),
        'platforms'=>\App\Models\platform::all(),
        'genres'=>\App\Models\genre::all()]);});
Route::get('/store', function () {

    $store=\App\Models\storeitem::with('platform');
    $store->Ffilters(request(['search','platform','genre']));
    return view('store1',[
        'storeitems'=>$store->where('num','>','0')->latest()->paginate(12),
        'platforms'=>\App\Models\platform::all(),
        'genres'=>\App\Models\genre::all(),
        'price'=>\App\Models\price::latest()->first()]);});
Route::middleware(['auth', 'verified'])->post('/createtest',[\App\Http\Controllers\testsController::class , 'create']);
Route::middleware(['auth', 'verified'])->get('/createtest',[linkcontroller::class , 'createtest']);
Route::middleware(['auth', 'verified'])->get('/dashboard/purchasepoints', [linkcontroller::class , 'purchasepoints']);
Route::middleware(['auth', 'verified'])->post('/buypoints', [UserController::class , 'addpoints']);
Route::get('store/{id}', function ($id) {

    $u=\App\Models\storeitem::findorfail($id);
    $genres=json_decode($u->genres);
    return view('storeitem',[
        'test'=>$u,
        'genres'=>$genres,
        'price'=>\App\Models\price::latest()->first()]);});
Route::middleware(['auth', 'verified'])->get('dashboard/exchange', function () {
    if(Auth::user()->ban==1)
        return view('banned');
    $x=\App\Models\tests::where('user_id',Auth::user()->id)->get();
    $points_in_tests=0;
    foreach($x as $test)
    {
        $points_in_tests=$points_in_tests+$test->remaining_points;
    }
    return view('dashboard.devexchange',[
            'points'=>$points_in_tests
    ]);
});
Route::middleware(['auth', 'verified'])->get('dashboard/aidrequest', function () {
    if(Auth::user()->ban==1)
        return view('banned');
    $x=\App\Models\tests::where('user_id',Auth::user()->id)->get();
    $points_in_tests=0;
    foreach($x as $test)
    {
        $points_in_tests=$points_in_tests+$test->remaining_points;
    }
    return view('dashboard.devaidrequest',[
           'points'=>$points_in_tests
    ]);
});
Route::get('/about', function () {
    return view('about.about');
})->name('about');
Route::get('/cookies', function () {
    $x=\App\Models\aboutpage::latest()->firstorfail();
    return view('about.cookiepolicy',[
        'info'=>$x
    ]);
})->name('cookies');
Route::get('/faq', function () {
    $x=\App\Models\aboutpage::latest()->firstorfail();
    return view('about.FAQ',[
        'info'=>$x
    ]);
})->name('faq');
Route::get('/legalnotice', function () {
    $x=\App\Models\aboutpage::latest()->firstorfail();
    return view('about.legalnotice',[
        'info'=>$x
    ]);
})->name('legalnotice');
Route::get('/presskit', function () {
    $x=\App\Models\aboutpage::latest()->firstorfail();
    return view('about.presskit',[
        'info'=>$x
    ]);
})->name('presskit');
Route::get('/privacypolicy', function () {
    $x=\App\Models\aboutpage::latest()->firstorfail();
    return view('about.privacypolicy',[
        'info'=>$x
    ]);
})->name('privacypolicy');
Route::get('/termsandconditions', function () {
    $x=\App\Models\aboutpage::latest()->firstorfail();
    return view('about.termsconditions',[
        'info'=>$x
    ]);
})->name('termsconditions');
Route::get('/dashboard/tester', function () {
    if(Auth::user()->ban==1)
        return view('banned');
    if(Auth::user()->role==1)
        abort(403);
    $t = \App\Models\testapps::with('tests')->has('tests')->where('user_id', Auth::user()->id)->latest()->paginate(6);
    return view('dashboard.registeredtests',[
        'tests'=>$t,
    ]);
});
Route::middleware(['auth', 'verified'])->get('/dashboard', function ()
{  if(Auth::user()->ban==1)
    return view('banned');
    if (Auth::user()->role==2) {
        $t = \App\Models\tests::with('platform')->where('user_id', Auth::user()->id)->latest()->paginate(6);
        $x=\App\Models\tests::where('user_id',Auth::user()->id)->get();
        $points_in_tests=0;
        foreach($x as $test)
        {
            $points_in_tests=$points_in_tests+$test->remaining_points;
        }
        return view('dashboard.managetests',
            [
                'tests' => $t,
                'points'=>$points_in_tests
            ]);
    }
    else {
        $t = \App\Models\testapps::with('tests')->where('user_id', Auth::user()->id)->latest()->paginate(6);

        return view('dashboard.tester_registeredtests',[
            'tests'=>$t
        ]);
    }
});
Route::middleware(['auth', 'verified'])->get('/dashboard/storepurchases', function () {
    if(Auth::user()->ban==1)
        return view('banned');
    $purchases=\App\Models\storepurchase::with('storecode','storeitem')->where('user_id',Auth::user()->id)->latest()->paginate(10);
    if(AUTH::user()->role==1)
        return view('dashboard.tester_storepurchases',[
            'purchases'=>$purchases
        ]);
    else
    return view('dashboard.storepurchases',[
        'purchases'=>$purchases
    ]);
});
Route::middleware(['auth', 'verified'])->post('/tests/{id}',[\App\Http\Controllers\testappsController::class , 'createsignup']);
Route::middleware(['auth', 'verified'])->post('/store/{id}',[\App\Http\Controllers\storepurchaseController::class , 'purchase']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/manage',[\App\Http\Controllers\testsController::class , 'update']);
Route::get('/tests/{id}', [linkcontroller::class , 'showtestitem']);
Route::get('redirects', [linkcontroller::class , 'index']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/manage', [testsController::class , 'edititem']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/nda', [testsController::class , 'nda']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/bugreports', [testsController::class , 'showbugreports']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/bugreports/reviewed', [testsController::class , 'reviewedbugreports']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/knownbugs', [testsController::class , 'knownbugs']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/keysinvites', [testsController::class , 'keysinvites']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/addkeys', [testsController::class , 'addkeyspage']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/addkeys', [\App\Http\Controllers\gamecodeController::class , 'addkeys']);
Route::post('/email/verify',[\App\Http\Controllers\UserController::class , 'changeemail']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/forms', [testsController::class , 'showforms']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/createform', [testsController::class , 'createform']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/nda', [testsController::class , 'createnda']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/knownbugs', [testsController::class , 'addknownbugs']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/createform', [testsController::class , 'addform']);
Route::middleware(['auth', 'verified'])->get('/notification', function () {
    $notifications=\App\Models\usernotification::where('user_id',Auth::user()->id)->latest()->limit(10)->get();return view('notofication',['notifications'=>$notifications]);});
Route::middleware(['auth', 'verified'])->get('/tests/{id}/tester', [testsController::class , 'testerpage']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/distribution', [testsController::class , 'showdistribution']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/distribution', [testsController::class , 'sendkeys']);
Route::middleware(['auth', 'verified'])->post('/dashboard/aidrequest', [UserController::class , 'aidrequest']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/acceptnda', [testsController::class , 'acceptnda']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/rejectnda', [testsController::class , 'rejectnda']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/myreports', [testsController::class , 'testerreportspage']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/tester/knownbugs', [testsController::class , 'testerknownbugs']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/myreports/create', [testsController::class , 'createreportpage']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/myreports/create', [testsController::class , 'createreport']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/myreports/{bugid}', [testsController::class , 'viewmyreport']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/bugreports/{bugid}', [testsController::class , 'viewreport']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/bugreports/{bugid}', [testsController::class , 'reviewreport']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/bugreports/reviewed/{bugid}', [testsController::class , 'reviewedreports']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/delete', [testsController::class , 'deletetest']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/delete', [testsController::class , 'deletetestpage']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/forms/{formid}', [testsController::class , 'showfeedbackforms']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/forms/{formid}/reviewed', [testsController::class , 'showreviewedfeedbackforms']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/forms/{formid}/reviewed/{submissionid}', [testsController::class , 'showreviewedsubmission']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/forms/{formid}/submissions/{submissionid}', [testsController::class , 'showsubmission']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/myforms', [testsController::class , 'showmyforms']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/revokeinvite/{testerid}', [testsController::class , 'revokeinvite']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/deletecode/{codeid}', [testsController::class , 'deletecode']);
Route::middleware(['auth'])->post('/createprofile', [UserController::class , 'createprofile']);
Route::middleware(['auth'])->post('/skipprofile', [UserController::class , 'skipprofile']);
Route::middleware(['auth'])->get('/account', [UserController::class , 'showaccount']);
Route::middleware(['auth'])->get('/account/email',function (){return view('profile.changeemail');});
Route::middleware(['auth'])->get('/account/password',function (){return view('profile.changepassword');});
Route::middleware(['auth', 'verified'])->get('/tests/{id}/myforms/{formid}/mysubmission', [testsController::class , 'showfeedback']);
Route::middleware(['auth'])->post('/account/password',[UserController::class , 'updatepassword']);
Route::middleware(['auth'])->post('/email/update', [UserController::class , 'updateemail']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/myforms/{formid}', [testsController::class , 'displayform']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/myforms/{formid}', [testsController::class , 'submitmyfeedback']);
Route::middleware(['auth'])->post('/account/update',[UserController::class , 'updateprofile']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/forms/{formid}/submissions/{submissionid}', [testsController::class , 'reviewsubmission']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/forms/{formid}/delete', [testsController::class , 'deleteform']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/forms/{formid}/setactive', [testsController::class , 'setactive']);
Route::middleware(['auth', 'verified'])->post('/tests/{id}/deleteimage/{imageid}', [testsController::class , 'deleteimage']);
Route::middleware(['auth', 'verified'])->get('/tests/{id}/forms/{formid}/view', [testsController::class , 'viewformfordev']);
Route::get('/boot', [\App\Http\Controllers\paymentcontroller::class , 'boot']);
Route::get('/pair', [\App\Http\Controllers\paymentcontroller::class , 'pair']);
Route::get('/invoice', [\App\Http\Controllers\paymentcontroller::class , 'createinvoice']);
Route::get('/getinvoice', [\App\Http\Controllers\paymentcontroller::class , 'getinvoice']);
Route::post('/payment', [\App\Http\Controllers\paymentcontroller::class , 'save']);


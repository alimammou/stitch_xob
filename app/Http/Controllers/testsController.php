<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\bugreport;
use App\Models\featuredStoreitems;
use App\Models\featuredTest;
use App\Models\Form;
use App\Models\gamecodes;
use App\Models\genre;
use App\Models\knownbugs;
use App\Models\nda;
use App\Models\Submission;
use App\Models\testapps;
use App\Models\tests;
use App\Models\User;
use App\Models\usernotification;
use App\Rules\buypoints;
use App\Rules\enoughpoints;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Support\Facades\Mail;
use Throwable;
use function PHPUnit\Framework\returnValue;

class testsController extends Controller
{
    public function create(request $request)
    {
        if(Auth::user()->ban==1)
            return view('banned');
        request()->validate(
            [
                'title'=>['required','unique:tests'],
                'description'=>'required',
                'platform_id'=>'required',
                'genres'=>'required',
                'page_status'=>'required',
                'tester_registration'=>'required',
                'rewardpool'=>'required',
                'version'=>'required',
                'trailer'=>'required',
                'test_status'=>'required',
                'thumbnail'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc1'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc2'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc3'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc4'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc5'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],

            ]
        );
        $zz=Helper::randomString(20);
        if($request->hasFile('thumbnail')){
            $filename1 = '/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'thumbnail.'.$zz;
            $request->thumbnail->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename1);
        }
        if($request->hasFile('sc1')){
            $filename2 = '/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc1.'.$zz;
            $request->sc1->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename2);
        }
        else
            $filename2=NUll;
        if($request->hasFile('sc2')){
            $filename3 = '/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc2.'.$zz;
            $request->sc2->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename3);
        }
        else
            $filename3=NUll;
        if($request->hasFile('sc3')){
            $filename4 = '/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc3.'.$zz;
            $request->sc3->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename4);
        }
        else
            $filename4=NUll;
        if($request->hasFile('sc4')){
            $filename5 = '/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc4.'.$zz;
            $request->sc4->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename5);
        }
        else
            $filename5=NUll;
        if($request->hasFile('sc5')){
            $filename6 =  '/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' .'sc5.'.$zz;
            $request->sc5->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' ),$filename6);
        }

        else
            $filename6=NUll;
        $this->validate($request, ['rewardpool' => new enoughpoints()]);
      //  ddd($request);
        tests::create([
            'title' => $request->title,
            'user_id' =>$request->user()->id,
            'description' => $request->description,
            'platforms_id'=>$request->platform_id,
            'genres'=>$request->genres,
            'trailer'=>$request->trailer,
            'page_status'=>$request->page_status,
            'tester_registration'=>$request->tester_registration,
            'version'=>$request->version,
            'test_status'=>$request->test_status,
            'rewardpool'=>$request->rewardpool,
            'remaining_points'=>$request->rewardpool,
            'pathtothumbnail'=>$filename1,
            'pathtosc1'=>$filename2,
            'pathtosc2'=>$filename3,
            'pathtosc3'=>$filename4,
            'pathtosc4'=>$filename5,
            'pathtosc5'=>$filename6,


            ]);
        $u= user::find(Auth::user()->id);
        $u->points=$u->points-$request->rewardpool  ;
        $u->save();
        return redirect('/dashboard');



    }
    public function update(request $request,$id)
    {   if(Auth::user()->ban==1)
        return view('banned');
        $test=tests::findorfail($id);
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        request()->validate(
            [
                'title'=>'required',
                'description'=>'required',
                'platform_id'=>'required',
                'genres'=>'required',
                'page_status'=>'required',
                'tester_registration'=>'required',
                'version'=>'required',
                'test_status'=>'required',
                'thumbnail'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc1'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc2'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc3'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc4'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],
                'sc5'=>['image','mimes:jpg,png,jpeg','max:450','dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'],

            ]
        );


        $t=tests::findorfail($id);

        $t->update([
            'title' => $request->title,
            'description' => $request->description,
            'platforms_id'=>$request->platform_id,
            'genres'=>$request->genres,
            'trailer'=>$request->trailer,
            'page_status'=>$request->page_status,
            'tester_registration'=>$request->tester_registration,
            'version'=>$request->version,
            'test_status'=>$request->test_status,


        ]);
        if(isset($request['extra_reward'])) {
            if ($request->extra_reward < 0) {
                return redirect()->back()->with('fail', 'invalid reward number');
            }
            if ($request->extra_reward > Auth::user()->points) {
                return redirect()->back()->with('fail', 'you don\'t have enough points');
            }
            $user=Auth::user();
            $user->points=$user->points-$request->extra_reward;
            $user->save();
            $t->rewardpool= $t->rewardpool+$request->extra_reward;
            $t->remaining_points= $t->remaining_points+$request->extra_reward;
            $t->save();
            }
        $zz=Helper::randomString(20);
        if($request->hasFile('thumbnail')){
            $filename1 ='/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'thumbnail'.$zz;
            $request->thumbnail->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename1);
            $t->pathtothumbnail=$filename1;
        }
        if($request->hasFile('sc1')){
            $filename2 ='/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc1'.$zz;
            $request->sc1->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename2);

            $t->pathtosc1=$filename2;
        }

        if($request->hasFile('sc2')){
            $filename3 ='/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc2'.$zz;
            $request->sc2->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename3);

            $t->pathtosc2=$filename3;
        }

        if($request->hasFile('sc3')){

            $filename4 ='/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc3'.$zz;

            $request->sc3->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename4);
            $t->pathtosc3=$filename4;

        }

        if($request->hasFile('sc4')){
            $filename5 ='/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc4'.$zz;
            $request->sc4->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename5);
            $t->pathtosc4=$filename5;
        }
        if($request->hasFile('sc5')){
            $filename6 ='/storage/'.date("Y").'/'.date("m") . '/' .date("d").'/' . 'sc5'.$zz;
            $request->sc5->move(public_path('/../../storage/'.date("Y").'/'.date("m") . '/' .date("d").'/'),$filename6);
            $t->pathtosc5=$filename6;
        }
        $t->save();
        return redirect()->back()->with('success','changes applied');
    }
    public function edititem(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);

        return view('devmanagement.edittest',
            [
                'test' => $x,
                'p'=>\App\Models\platform::all(),
                'g'=>genre::all()
            ]);
    }
    public function nda(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        if(tests::find($id)->nda()->exists()) {
         //   ddd($x->nda()->get());
            return view('devmanagement.ndaexists',
                [
                    'test' => $x,
                    'nda' => $x->nda()->get()
                ]);
        }
        else
        return view('devmanagement.nda',
            [
                'test' => $x
            ]);
    }
    public function showbugreports(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $bugs=bugreport::where('tests_id',$id)->where('status','new')->paginate();
        return view('devmanagement.reviewbugs',
            [
                'test' => $x,
                'bugs'=>$bugs
            ]);
    }
    public function reviewedbugreports(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $bugs=bugreport::where('tests_id',$id)->where('status','reviewed')->paginate();
        return view('devmanagement.reviewdbugs',
            [
                'test' => $x,
                'bugs'=>$bugs
            ]);
    }
    public function viewreport(Request $request,$id,$bugid)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $bugs=bugreport::findorfail($bugid);
        if($bugs->status=="reviewed") {
            abort(403);
        }
        return view('devmanagement.reviewreport',
            [
                'test' => $x,
                'bug'=>$bugs
            ]);
    }
    public function deletetestpage(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        return view('devmanagement.deleteconfirmation',
            [
                'test' => $x,
            ]);
    }
    public function deletetest(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $user=Auth::user();
        $user->points=$user->points+$x->remaining_points;
        $user->save();
        $x->delete();
        $testers=testapps::where('tests_id',$id)->get();
        foreach($testers as $test)
        {
            $test->delete();
        }
        $tests=featuredTest::where('tests_id',$id)->get();
        foreach($tests as $test)
        {
            $test->delete();
        }
        $store=featuredStoreitems::where('tests_id',$id)->get();
        foreach($store as $test)
        {
            $test->delete();
        }
        return redirect("/dashboard");
    }

    public function reviewedreports(Request $request,$id,$bugid)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $bugs=bugreport::findorfail($bugid);
        if($bugs->status=="new") {
            abort(403);
        }
        return view('devmanagement.reviewedreport',
            [
                'test' => $x,
                'bug'=>$bugs
            ]);
    }
    public function reviewreport(Request $request,$id,$bugid)
    {
        $request->validate([
            'goodOrBad'=>'required',
            'points'=>'required'
        ]);
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        if($request->points>$test->remaining_points)
            return redirect()->back()->with('fail','you don\'t have  enough points' );
        $bugs=bugreport::findorfail($bugid);
         $test->remaining_points=$test->remaining_points-$request->points;
         $test->save();
        $user=User::find($bugs->user_id);
        $user->tester_points=$user->tester_points+$request->points;
        $user->save();
      $bugs->status="reviewed";
      $bugs->score=$request->goodOrBad;
      $bugs->reward=$request->points;
      $bugs->save();
          usernotification::create([
              'user_id'=>$bugs->user_id,
              'tests_id'=>$id,
              'text'=>Auth::user()->devname. ' has reviewed your bug report'
          ]);
      return redirect("/tests/".$id."/bugreports");

    }

    public function knownbugs(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        return view('devmanagement.knownbugs',
            [
                'test' => $x
            ]);
    }
public function keysinvites(Request $request,$id){
    $x= \App\Models\tests::with('gamecodes')->withCount([
        'forms',
        'gamecodes',
        'testapps',
        'testapps as claimed_keys'=> function (\Illuminate\Database\Eloquent\Builder $query) {
            $query->where('approved', '1');
        },
        'testapps as invited'=> function (\Illuminate\Database\Eloquent\Builder $query) {
            $query->whereNotNull('invited_on');
        },
        'gamecodes as not_sent' => function (\Illuminate\Database\Eloquent\Builder $query) {
            $query->where('sent_on', NULL);
        },])->findOrFail($id);
    $test=tests::findorfail($id);
    if(Auth::user()->ban==1)
        return view('banned');
    if(Auth::user()->id!=$test->user_id)
        abort(403);
    $testers=testapps::with('gamecodes')->withCount([
        'bugs',
        'submissions'
    ])->where('tests_id',$id)->whereNotNull('invited_on')->latest()->paginate();
 //   ddd($x);
    $codes=gamecodes::where('tests_id',$id)->where('sent_on',null)->latest()->paginate();
    return view('devmanagement.availablekeys',
        [
            'test' => $x,
            'testers'=>$testers,
            'codes'=>$codes
        ]);
}
    public function revokeinvite(Request $request,$id,$testerid)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $tester=testapps::with('gamecodes')->where('tests_id',$id)->where('id',$testerid)->firstorfail();
        if($tester->approved==1)
            return redirect()->back()->with('fail','this tester already claimed his key');
        else
        {
            $code=$tester->gamecodes;
            $code->testapp_id=null;
            $code->sent_on=null;
            $code->save();
            $tester->invited_on=null;
            $tester->save();
            return redirect()->back()->with('success','invited deleted succesfully');
        }

    }
    public function deletecode(Request $request,$id,$codeid)
    {
        $x = \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $tester = gamecodes::where('tests_id', $id)->where('id', $codeid)->firstorfail();
        if ($tester->sent_on != null) {
            return redirect()->back()->with('fail', 'key already claimed');
        }
        else {

            $tester->delete();
            return redirect()->back()->with('sucess', 'key deleted succesfully');
        }

    }
    public function addkeyspage(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        return view('devmanagement.addkeys',
            [
                'test' => $x
            ]);
    }
    public function showsubmission(Request $request,$id,$formid,$submissionid)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $form=Form::findorfail($formid);
        $submissions=Submission::where('tests_id',$id)->where('status','new')->where('id',$submissionid)->firstorfail();
        return view('devmanagement.reviewsubmission',
            [
                'test' => $x,
                'submissions'=>$submissions,
                'form'=>$form
            ]);
    }
    public function reviewsubmission(Request $request,$id,$formid,$submissionid)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        $submissions = Submission::where('tests_id', $id)->where('status', 'new')->where('id', $submissionid)->firstorfail();
        $request->validate([
            'spam'=>'required',
            'reward'=>'required'
        ]);

        $form = Form::findorfail($formid);
        $form->form_builder_json=json_decode($form->form_builder_json);
        $count=count($request->score);
        $score=$request->score;
        if($request->spam==1)
        {
            for($i=0;$i<count($form->form_builder_json);$i++) {
                $review[$i]='1';
            }
            $submissions->update([
               'review'=>json_encode($review),
            'score'=>'0',
                'reward'=>'0',
                'status'=>'reviewed',
                'reviewed_at'=>\Carbon\Carbon::now()->toDateTimeString()
            ]);
            return redirect('/tests/'.$id.'/forms');
        }

        $x = \App\Models\tests::findorfail($id);
        if($x->remaining_points<$request->reward)
        {
            return redirect()->back()->with('fail','not enough points');
        }
        $x->remaining_points=$x->remaining_points-$request->reward;
        $x->save();
        for($i=0;$i<count($form->form_builder_json);$i++)
        {
            if($form->form_builder_json[$i]->type=="shorttext"||$form->form_builder_json[$i]->type=="largetext")
            {
                $score[$i]=$request['score'.$i];
            }
            else{
                $score[$i]='3';
            }
        }
        if(!isset($request['reward']))
        {
            return redirect()->back()->with('fail','you need to specify the reward amount');
        }
        if(count($form->form_builder_json)>count($score))
        {
            return redirect()->back()->with('fail','you need to fill all the fields');
        }
        $sc=0;
        for($i=0;$i<count($score);$i++) {
            $sc+=$score[$i];
        }
        $user=User::find($submissions->user_id);
        $user->tester_points=$user->tester_points+$request->reward;
        $user->save();
        $sc=$sc/count($score);
        $submissions->update([
            'review'=>json_encode($score),
            'score'=>ceil($sc),
            'reward'=>$request->reward,
            'status'=>'reviewed',
            'reviewed_at'=>\Carbon\Carbon::now()->toDateTimeString()
        ]);
        usernotification::create([
            'user_id'=>$submissions->user_id,
            'tests_id'=>$x->id,
            'text'=>Auth::user()->devname.' has reviewed your feedback.',
        ]);
     return redirect('/tests/'.$id.'/forms');
    }
        public function showreviewedsubmission(Request $request,$id,$formid,$submissionid)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $form=Form::findorfail($formid);
        $submissions=Submission::where('tests_id',$id)->where('status','reviewed')->where('id',$submissionid)->firstorfail();
        return view('devmanagement.reviewedsubmission',
            [
                'test' => $x,
                'submissions'=>$submissions,
                'form'=>$form
            ]);
    }
    public function showreviewedfeedbackforms(Request $request,$id,$formid)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $form=Form::findorfail($formid);
        $submissions=Submission::where('tests_id',$id)->where('form_id',$formid)->where('status','reviewed')->latest()->paginate();
        return view('devmanagement.reviewedfeedbackforms',
            [
                'test' => $x,
                'submissions'=>$submissions,
                'form'=>$form
            ]);
    }

    public function showfeedbackforms(Request $request,$id,$formid)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $form=Form::findorfail($formid);
        $submissions=Submission::where('tests_id',$id)->where('form_id',$formid)->where('status','new')->latest()->paginate();
        return view('devmanagement.notreviewdfeedbackforms',
            [
                'test' => $x,
                'submissions'=>$submissions,
                'form'=>$form
            ]);
    }
    public function showforms(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);
        $forms=Form::where('tests_id',$id)->latest()->paginate();
        return view('devmanagement.feedbackforms',
            [
                'test' => $x,
                'forms'=>$forms
            ]);
    }
    public function createform(Request $request,$id)
    {
        $x= \App\Models\tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);

        return view('devmanagement.createfeedbackforms',
            [
                'test' => $x
            ]);
    }
public function createnda(Request $request,$id)
{
$test=tests::findorfail($id);
    if(Auth::user()->ban==1)
        return view('banned');
    if(Auth::user()->id!=$test->user_id)
        abort(403);
    request()->validate(
        [
            'nda'=>'required',

        ]);
    if(tests::find($request->id)->nda()->exists()) {
        $z = tests::find($request->id)->nda()->get();
        $z[0]->update([
            'nda' => $request->nda,
            'required' => $request->required,
            'timelimit' => $request->timelimit


        ]);
    }
    else {
        nda::create([
            'tests_id' => $request->id,
            'nda' => $request->nda,
            'required' => $request->required,
            'timelimit' => $request->timelimit


        ]);
    }
    return redirect()->back()->with('success','changes have been saved' );
}
    public function addform(Request $request,$id)
    {
        $test=tests::withCount('forms')->findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        $request->validate([
            'title'=>'required'
        ]);
if($request->x==null)
    return redirect()->with('fail','there was an error processing your request');
if($test->forms_count==0)
{
    Form::create([
        'name' => $request->title,
        'form_builder_json' => $request->x,
        'tests_id' => $id,
        'active'=>'1'
    ]);
}
else {
    Form::create([
        'name' => $request->title,
        'form_builder_json' => $request->x,
        'tests_id' => $id
    ]);
}
return redirect('/tests/'.$id.'/forms');
    }
    public function addknownbugs(Request $request,$id)
    {
$test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        request()->validate(
            [
                'text'=>'required',

            ]);
        if(tests::find($request->id)->knownbugs()->exists()) {
            $z = tests::find($request->id)->knownbugs()->get();
            $z[0]->update([
                'text' => $request->text,


            ]);
        }
        else {
            knownbugs::create([
                'tests_id' => $id,
                'text' => $request->text,


            ]);
        }
        return redirect()->back()->with('success','you have updated your NDA' );
    }
    public function testerreportspage(Request $request,$id)
    {
        $test=tests::findorfail($id);

        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        $bugs=bugreport::where('user_id', Auth::user()->id)->where('tests_id',$id)->latest()->paginate();
 return view('testertestmanagement.reports',
 [
     'test'=>$test,
     'bugs'=>$bugs
 ]);
    }
    public function showmyforms(Request $request,$id)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        //    $bugs=bugreport::where('user_id', Auth::user()->id)->where('tests_id',$id)->latest()->get();
          $form=Form::where('tests_id',$id)->where('active','1')->first();
          $submissions=Submission::with('form')->where('user_id',Auth::user()->id)->where('tests_id',$id)->latest()->paginate(10);
        return view('testertestmanagement.feedbackforms',
            [
                'test'=>$test,
                'form'=>$form,
                'submissions'=>$submissions
            ]);
    }
    public function submitmyfeedback(Request $request,$id,$formid)
    {
        $test = tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        //    $bugs=bugreport::where('user_id', Auth::user()->id)->where('tests_id',$id)->latest()->get();
        $form = Form::where('tests_id', $id)->where('active', '1')->where('id', $formid)->firstorfail();
        $form->form_builder_json = json_decode($form->form_builder_json);
        //  ddd(count($form->form_builder_json));
        $submission=$form->form_builder_json;
        for ($i = 0; $i < count($form->form_builder_json); $i++) {
            if (!isset($request['question-' . $i]))
                return redirect()->back()->with('fail', 'you need to fill all fields');
            else
            {
                $submission[$i]->answer=$request['question-' . $i];
            }
        }
        $tester=testapps::where('tests_id',$id)->where('user_id',Auth::user()->id)->firstorfail();
        $submission=json_encode($submission);
        Submission::create([
           'form_id'=>$formid,
            'tests_id'=>$id,
            'user_id'=>Auth::user()->id,
            'testapp_id'=>$tester->id,
            'content'=>$submission,
            'status'=>'new'

        ]);
        return redirect('/tests/'.$id.'/myforms')->with('success','you have succesfully submitted this feedback');
    }
    public function displayform(Request $request,$id,$formid)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        $submission=Submission::where('form_id',$formid)->where('user_id',Auth::user()->id)->first();
        if($submission)
            return redirect('/tests/'.$id."/myforms/".$submission->id."/mysubmission");
        //    $bugs=bugreport::where('user_id', Auth::user()->id)->where('tests_id',$id)->latest()->get();
        $form=Form::where('tests_id',$id)->where('active','1')->where('id',$formid)->firstorfail();
        //$form->form_builder_json=json_decode($form->form_builder_json);

        return view('testertestmanagement.feedbackformedit',
            [
                'test'=>$test,
                'form'=>$form
            ]);
    }
    public function viewformfordev(Request $request,$id,$formid)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        $form=Form::where('tests_id',$id)->where('id',$formid)->firstorfail();
        //$form->form_builder_json=json_decode($form->form_builder_json);
     return view('devmanagement.viewmyform',[
         'form'=>$form,
         'test'=>$test
     ]);
    }
    public function deleteform(Request $request,$id,$formid)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        $form=Form::where('tests_id',$id)->where('id',$formid)->firstorfail();
        //$form->form_builder_json=json_decode($form->form_builder_json);
$form->delete();
        return redirect()->back()->with('sucess','you have sucessfully eleted a form');
    }
    public function setactive(Request $request,$id,$formid)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        $form=Form::where('tests_id',$id)->where('id',$formid)->firstorfail();
       $forms=Form::where('tests_id',$id)->get();
       foreach ($forms as $f) {
           if ($f->active == '1') {
               $f->active=0;
                   $f->save();
           }
       }
       $form->active=1;
       $form->save();
       $testers=testapps::where('tests_id',$id)->where('approved','1')->get();
       foreach($testers as $tester)
       {
           usernotification::create([
               'user_id'=>$tester->user_id,
               'tests_id'=>$test->id,
               'text'=>Auth::user()->devname.' has changed the feedback form for their game '.$test->title,
           ]);
       }
        return redirect()->back()->with('sucess','you have sucessfully changed the active form');
    }
    public function showfeedback(Request $request,$id,$formid)
    {
        $test=tests::findorfail($id);

        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        $submission=Submission::where('id',$formid)->where('user_id',Auth::user()->id)->firstorfail();
       if($submission->status=='new')
       {
           return view('testertestmanagement.feedbacknotreviewed',
               [
                   'submission'=>$submission,
                   'test'=>$test,
               ]);
       }
       elseif($submission->status=='reviewed')
        return view('testertestmanagement.feedbackreviewed',
            [
                'submission'=>$submission,
                'test'=>$test,
            ]);
    }
    public function showmyform(Request $request,$id)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        //    $bugs=bugreport::where('user_id', Auth::user()->id)->where('tests_id',$id)->latest()->get();
        return view('testertestmanagement.feedbackformedit',
            [
                'test'=>$test
            ]);
    }
    public function viewmyreport(Request $request,$id,$bugid)
    {
        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        $bug=bugreport::findorfail($bugid);
        $test=tests::findorfail($id);
    //    $bugs=bugreport::where('user_id', Auth::user()->id)->where('tests_id',$id)->latest()->get();
        return view('testertestmanagement.viewreport',
            [
                'test'=>$test,
                'bug'=>$bug
            ]);
    }
    public function createreportpage(Request $request,$id)
    {
        $test=tests::findorfail($id);

        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        return view('testertestmanagement.createreport',
            [
                'test'=>$test
            ]);
    }
    public function createreport(Request $request,$id)
    {
        $request->validate  ([
        'title'=>'required',
            'bug_report'=>'required',
            'steps_to_reproduce'=>'required',

            ]);
        $tester=testapps::where('user_id', Auth::user()->id)->where('tests_id',$id)->first();

        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        bugreport::create([
            'title'=>$request->title,
            'bug'=>$request->bug_report,
            'stepsto'=>$request->steps_to_reproduce,
            'user_id'=>Auth::user()->id,
            'tests_id'=>$id,
            'status'=>'new',
            'testapp_id'=>$tester->id
        ]);
        return redirect("/tests/".$id."/myreports");
    }

    public function testerknownbugs(Request $request,$id)
    {
        $test=tests::findorfail($id);

        if(Auth::user()->ban==1)
            return view('banned');
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
$knownbugs=knownbugs::where('tests_id',$id)->first();
        return view('testertestmanagement.knownbugs',
            [
                'test'=>$test,
                'knownbugs'=>$knownbugs
            ]);
    }

    public function testerpage(Request $request,$id)
    {
        $tester=testapps::with('gamecodes')->where('user_id', Auth::user()->id)->where('tests_id',$id)->whereNotNull('invited_on')->firstorfail();
        if($tester->approved==0)
        {
            $test=tests::findorfail($id);
            return view('testertestmanagement.NDA',[
                'test'=>$test,
            ]);
        }
        else {
            $test=tests::findorfail($id);
            return view('testertestmanagement.invitedetails',[
                'test'=>$test,
                'tester'=>$tester
            ]);
        }
    }
    public function showdistribution(Request $request,$id)
    {
        $x= \App\Models\tests::with('gamecodes')->withCount([
            'gamecodes',
            'testapps',
            'testapps as claimed_keys'=> function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('approved', '1');
            },
            'testapps as invited'=> function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->whereNotNull('invited_on');
            },
            'gamecodes as not_sent' => function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('sent_on', NULL);
            },])->findOrFail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$x->user_id)
            abort(403);

        return view('devmanagement.distribution',[
            'test'=>$x
        ]);
    }
    public function sendkeys(Request $request,$id)
    {

        request()->validate(
            [
                'number_of_testers'=>'required',

            ]);

        $x= \App\Models\tests::with('gamecodes')->withCount([
            'gamecodes',
            'testapps',
            'gamecodes as not_sent' => function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('sent_on', NULL);
            },])->findOrFail($id);
        $test=$x;
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);

        if($test->not_sent<$request->number_of_testers) {
            return redirect()->back()->with('fail','you need to add more keys' );
        }
        else if(($test->testapps_count-($test->gamecodes_count-$test->not_sent))<$request->number_of_testers)
        {
            return redirect()->back()->with('fail','not enough sign-ups' );
        }
        else if($request->number_of_testers<0)
        {
            return redirect()->back()->with('fail','please enter a valid number' );
        }
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $t=testapps::where('invited_on', null)->where('tests_id', $id)->inRandomOrder()->limit($request->number_of_testers)->get();
        $codes=gamecodes::where('tests_id',$id)->where('sent_on',null)->limit($request->number_of_testers)->get();
        //ddd($codes);
        for ( $i = 0; $i < $request->number_of_testers; $i++) {
          $codes[$i]->testapp_id=$t[$i]->id;
            $codes[$i]->sent_on=$current_date_time;
            $t[$i]->invited_on=$current_date_time;
            if(tests::find($id)->nda()->exists())
            {
                $nda=nda::where('tests_id',$id)->first();
                $t[$i]->nda_text=$nda->nda;
            }
            else
            {
                $t[$i]->approved='1';
            }
            $codes[$i]->save();
            $t[$i]->save();
            $content=["content"=>'you have been invited to test '.$test->title.'
            Https:://stitch.gmaes/tests/'.$test->id.'/tester' ];
            $user=User::find($t[$i]->user_id)->first();
            Mail::send( 'emails.email',$content, function ($message) use ($user) {
                $message->subject('New test invite');
                $email = $user->email;
                $message->to($email);
            });

            usernotification::create([
                'user_id'=>$t[$i]->user_id,
                'tests_id'=>$test->id,
                'text'=>'you have been invited to test '.$test->title,
            ]);
        }
        if($request->number_of_testers==1)
        return redirect()->back()->with('sucess','you have succesfully invited '.$request->number_of_testers.' tester' );
        else
            return redirect()->back()->with('sucess','you have succesfully invited '.$request->number_of_testers.' testers' );
    }
    public function acceptnda(Request $request,$id)
    {
        $t=testapps::where('tests_id',$id)->whereNotNull('invited_on')->where('user_id',Auth::user()->id)->firstorfail();
        $t->approved='1';
        $t->save();
        return redirect("/tests/".$id."/tester");
    }
    public function rejectnda(Request $request,$id)
    {
        $t=testapps::where('tests_id',$id)->where('user_id',Auth::user()->id)->whereNotNull('invited_on')->firstorfail();
        $code=gamecodes::where('testapp_id',$t->id)->firstorfail();
        $code->sent_on=null;
        $code->testapp_id=null;
        $code->save();
        $t->forcedelete();
        return redirect('/dashboard');
    }
    public function deleteimage(Request $request,$id,$imageid)
    {
        $test=tests::findorfail($id);
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->id!=$test->user_id)
            abort(403);
        if($imageid==1)
        {
            $test->pathtosc1=null;
            $test->save();
            return redirect()->back();
        }
        if($imageid==2)
        {
            $test->pathtosc2=null;
            $test->save();
            return redirect()->back();
        }
        if($imageid==3)
        {
            $test->pathtosc3=null;
            $test->save();
            return redirect()->back();
        }
        if($imageid==4)
        {
            $test->pathtosc4=null;
            $test->save();
            return redirect()->back();
        }
        if($imageid==5)
        {
            $test->pathtosc5=null;
            $test->save();
            return redirect()->back();
        }
        if($imageid==0)
        {
            $test->pathtothumbnail=null;
            $test->save();
            return redirect()->back();
        }
    }
}
//,'dimensions:min_width=100,min_height=100,max_width=1280,max_height=720'

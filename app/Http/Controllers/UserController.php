<?php

namespace App\Http\Controllers;

use App\Http\Requests\changeemailrequest;
use App\Models\aidrequest;
use App\Models\genre;
use App\Models\platform;
use App\Models\profile;
use App\Models\User;
use App\Rules\buypoints;
use App\Rules\enoughpoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addpoints(Request $request)
    { if(Auth::user()->ban==1)
        return view('banned');

        // request()->validate(
        //      [
        //         'points'=>['required']
        //     ]
        //   );
        //   $this->validate($request, ['points' => new buypoints()]);
        //  $u= user::find(Auth::user()->id);
        // $u->points=$u->points+$request->points  ;
        //  $u->save();
        return redirect();
    }

    public function aidrequest(Request $request)
    {

        request()->validate(
            [
                'name' => ['required'],
                'gameplay' => 'required',
                'numberoftesters' => 'required'
            ]
        );
        aidrequest::create([
            'User_id' => Auth::user()->id,
            'name' => $request->name,
            'website' => $request->website,
            'socialmedia' => $request->social_media,
            'gameplay' => $request->gameplay,
            'playersnum' => $request->numberoftesters
        ]);
        return redirect()->back()->with('success', 'aid request sent, please wait while our team check your request');
    }

    public function changeemail(request $request)
    {
        $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'current_password' => 'required'
            ]
        );
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('fail', 'wrong password');
        }
        $user->email = $request->email;
        $user->save();
        $user->sendEmailVerificationNotification();
        return redirect()->back();
    }

    public function createprofile(request $request)
    {
        $request->validate([
            'country' => 'required',
            'date_of_birth' => 'required|before:2008-1-1|after:1950-1-1',
            'sex' => 'required',
            'native_language' => 'required',
            'secondary_lanuguage' => 'required',
            'platform' => 'required',
            'secondary_platform' => 'required',
            'genres' => 'required'

        ]);
        if(Auth::user()->ban==1)
            return view('banned');
        profile::create([
            'user_id' => Auth::user()->id,
            'country' => $request->country,
            'gender' => $request->sex,
            'DOB' => $request->date_of_birth . ' 00:00:00',
            'native_language' => $request->native_language,
            'secondary_language' => $request->secondary_lanuguage,
            'platform' => $request->platform,
            'secondary_platform' => $request->secondary_platform,
            'genres' => $request->genres
        ]);

        return redirect('/')->with('success', 'profile created succesfully');
    }

    public function skipprofile(request $request)
    {
        $user = Auth::user();
        $user->skipped_profile = '1';
        $user->save();


        return redirect('/');
    }

    public function showaccount(request $request)
    {
        if(Auth::user()->ban==1)
            return view('banned');
        if (AUTH::user()->profile()->exists()) {
            $profile=AUTH::user()->profile()->with('platform','secondaryplatform')->first();
            $genres=genre::all();
            return view('profile.profile',[
                'profile'=>$profile,
                    'genres'=>$genres,
                    'p'=>platform::all()
                ]
            );
        }
        else {
            $genres = genre::all();
            return view('profile.createprofile', [
                'genres' => $genres,
                'platforms' => platform::all()
            ]);
        }
    }

    public function updateemail(request $request)
    {
        $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'current_password' => 'required',
                'email_confirmation' => 'required'
            ]
        );
        if ($request->email_confirmation != $request->email) {
            return redirect()->back()->with('error', 'email and email confirmation must match');
        }
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('fail', 'wrong password');
        }
        $user->email_verified_at=null;
        $user->email = $request->email;
        $user->save();
        $user->sendEmailVerificationNotification();
        return redirect()->back()->with('success', 'email change succesfully, please check your email for confirmation');
    }


    public function updatepassword(request $request)
    {
        $request->validate( [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)],
            'password_confirmation'=>'required'
        ]);
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('fail', 'wrong password');
        }
        if($request->password!=$request->password_confirmation)
        {
            return redirect()->back()->with('fail', 'password and password confirmation must match');
        }
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
        return redirect()->back()->with('success','password updated succesfully');
    }
    public function updateprofile(request $request)
    {
        $request->validate([
            'platform' => 'required',
            'secondary_platform' => 'required',
            'genres' => 'required'

        ]);
        $profile=profile::where('user_id',Auth::user()->id);
        $profile->update([
            'platform' => $request->platform,
            'secondary_platform' => $request->secondary_platform,
            'genres' => $request->genres
        ]);

        return redirect()->back()->with('success', 'profile created succesfully');
    }
}

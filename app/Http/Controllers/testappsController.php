<?php

namespace App\Http\Controllers;

use App\Models\tests;
use App\Models\testapps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class testappsController extends Controller
{
    public function createsignup(Request $request,$id)
    { if(Auth::user()->ban==1)
        return view('banned');
        $test=tests::findorfail($id);
        if($test->tester_registration=='0')
            return redirect()->back()->with('fail','developer has turned off registration for this test' );
        if($test->test_status=='Complete')
            return redirect()->back()->with('fail','developer has ened this test' );
        if(testapps::where('user_id',Auth::user()->id)->where('tests_id',$id)->exists())
            return redirect()->back()->with('fail','you have already applied for this test' );
        \App\Models\testapps::create([
            'user_id' => $request->user_id,
            'tests_id' => $id,



        ]);
        return redirect()->back()->with('success','you have succesfully applied for the test' );
    }
}

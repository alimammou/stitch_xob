<?php

namespace App\Http\Controllers;

use App\Models\gamecodes;
use App\Models\storeitem;
use App\Models\tests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class gamecodeController extends Controller
{
    public function addkeys(Request $request,$id)
    {
        $tests=tests::findorfail($id);
        if(Auth::user()->id!=$tests->user_id)
            abort(403);
        if(Auth::user()->ban==1)
        return view('banned');
        $request->validate(
            [
                'code'=>['required','unique:gamecodes']
            ]
        );

        $c=preg_split("/\r\n|\n|\r/", $request->code);
        foreach( $c as $line) {
            $code=new gamecodes();
            $code->tests_id=$id;
            $code->code=$line;
            $code->save();
        }
        return redirect('/tests/'.$id.'/keysinvites')->with('message','you have succesfully added keys' );
    }
}

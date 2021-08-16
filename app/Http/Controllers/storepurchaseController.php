<?php

namespace App\Http\Controllers;

use App\Models\price;
use App\Models\storecode;
use App\Models\storeitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class storepurchaseController extends Controller
{
    public function purchase(Request $request,$id)
    { if(Auth::user()->ban==1)
        return view('banned');
        $x=storeitem::find($id);
        $p=price::latest()->first();
        $price=$x->price*10*$p->rate;
        if($x->num==0)
        {
            return redirect()->back()->with('fail','out of stock' );
        }
        if($request->user()->tester_points<$price)
        {
            return redirect()->back()->with('fail','not enough points' );
        }
        $x->num=$x->num-1;
        $x->save();
        $user=$request->user();
        $user->tester_points= $user->tester_points-$price;
        $user->save();
        $code=storecode::where('ispurchased', 0)
        ->where('storeitem_id', $id)->limit(1)
        ->update(['ispurchased' => 1]);
        \App\Models\storepurchase::create([
            'user_id' => Auth::user()->id,
            'storeitem_id' => $request->storeitem_id,
            'storecode_id'=>$code,
            'purchasedfor'=>$price



        ]);
        $content=["content"=>'you have you have purchased a new game '. $x->title.'you can view your game code at

            http://127.0.0.1:8000/dashboard/storepurchases' ];
        $user=$request->user();
        Mail::send( 'emails.email',$content, function ($message) use ($user) {
            $message->subject('New game purchase');
            $email = $user->email;
            $message->to($email);
        });
        return redirect()->back()->with('message','you have succesfully purchased this game' );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\genre;
use App\Models\platform;
use App\Models\price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class linkcontroller extends Controller
{

    public function managetests(Request $request)
    {
        $t=\App\Models\tests::where('user_id', Auth::user()->id)->get();
        var_dump('1');
        return view('dashboard.managetests',[
            'tests'=>$t
        ]);
    }
    public function purchasepoints(Request $request)
    { if(Auth::user()->ban==1)
        return view('banned');
        $x=\App\Models\tests::where('user_id',Auth::user()->id)->get();
        $points_in_tests=0;
        foreach($x as $test)
        {
            $points_in_tests=$points_in_tests+$test->remaining_points;
        }
        return view('dashboard.purchasepoints',[
            'pricing'=>price::latest()->first(),
            'points'=>$points_in_tests
        ]);
    }

    public function createtest(Request $request)
    {
        if(Auth::user()->ban==1)
            return view('banned');
        if(Auth::user()->role==1)
            abort(403);
        else
        return view('creattest',
        [
            'p'=>platform::all(),
            'g'=>genre::all()
        ]);

    }

    public function showtestitem(Request $request,$id)
    {
       $x= \App\Models\tests::findorfail($id);
       $genres=json_decode($x->genres);
        return view('testitem',
            [
                'test' => $x,
                'genres'=>$genres
            ]);
    }
    public function index()
    {if(Auth::user()->skipped_profile==0)
        {
            if (!AUTH::user()->profile()->exists()) {
                //  ddd(AUTH::user()->profile()->exists());
                $genres = genre::all();
                $platforms=platform::all();
                return view('auth.moredetailsregister', [
                    'genres' => $genres,
                    'platforms'=>$platforms
                ]);
            }
            else
                return redirect('/');
        }
        else
            return redirect('/');
    }

}

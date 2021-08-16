<x-app-layout>

    <x-slot name="header">

        @if(Auth::check())

            <li class="nav-item navItem nIUser" id="showThisOnceLoggedIn">
                <div class="nav-item dropdown DDNavItem"><a class="dropdown-toggle linkDLUserNav" aria-expanded="false" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu menuDL">
                        <div class="divUserInfoNav">
                            <p class="dUINPara">Rank:&nbsp;<span class="dUINPSpan">Bronze</span></p>
                        </div><a class="dropdown-item mDLItem" href="/account">Account</a><a class="dropdown-item mDLItem" href="/notification">Notifications</a>
                        <a class="dropdown-item mDLItem mDLITomato" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>

        @else
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>     @endif

    </x-slot>
    <div class="divMainContent">
        <div class="divCustomContainer">
            <div class="divPageTitleMain divTitleGamePage">
                <h1 class="headingPageTitleMain">{{$test->title}}</h1>
            </div>
            @if($test->user->id==1)

                <div class="divMessageStaffCreatedTest">
                    <p class="dMSCTPara">Notice: This is a staff created test. The actual developer did not create this test. Feedback and bug reports will be forwarded to the developer when possible. This is done to grow the tester community on Stitch and increase activity, as well as take the first step to help out indie developers.</p>
                </div>
            @endif
            <div class="divGamePage">

                <div class="dGP dGPLeft">
                    <div class="dGPVideo">{!!   Embed::make($test->trailer)->parseUrl()->setAttribute(['width' => '100%','height' => '100%','allowfullscreen'=>'','frameborder'=>'0','class'=>'videoGPV'])->getIframe()!!}</div>
                    <div class="photo-gallery">
                        <div class="photos">
                            @if($test->pathtosc1)
                                <div class="item"><a class="linkGallary" data-lightbox="photos" href="{{asset($test->pathtosc1)}}"><img class="img-fluid" src="{{asset($test->pathtosc1)}}"></a></div>
                            @endif
                            @if($test->pathtosc2)
                                <div class="item"><a class="linkGallary" data-lightbox="photos" href="{{asset($test->pathtosc2)}}"><img class="img-fluid" src="{{asset($test->pathtosc2)}}"></a></div>
                            @endif
                            @if($test->pathtosc3)
                                <div class="item"><a class="linkGallary" data-lightbox="photos" href="{{asset($test->pathtosc3)}}"><img class="img-fluid" src="{{asset($test->pathtosc3)}}"></a></div>
                            @endif
                            @if($test->pathtosc4)
                                <div class="item"><a class="linkGallary" data-lightbox="photos" href="{{asset($test->pathtosc4)}}"><img class="img-fluid" src="{{asset($test->pathtosc4)}}"></a></div>

                            @endif
                            @if($test->pathtosc5)
                                <div class="item"><a class="linkGallary" data-lightbox="photos" href="{{asset($test->pathtosc5)}}"><img class="img-fluid" src="{{asset($test->pathtosc5)}}"></a></div>
                            @endif
                        </div>
                    </div>
                    <div class="dGPDetails">
                        <h2 class="headingGPD">About</h2>
                        <p class="paraGPD"><br>{!! nl2br($test->description)!!}<br></p>
                    </div>
                </div>
                <div class="dGP dGPRight">
                    <div class="dGPThumbnail"><img
                        class="imgGPT" src="{{asset($test->pathtothumbnail)}}"></div>
                    <div class="dGPDetails2">

                        <form action="/tests/{{$test->id}}" method="POST">

                            @csrf
                            @if(\Illuminate\Support\Facades\Auth::check())
                            <input type="hidden" name="user_id" value="{{AUTH::USER()->id}}">
                            @endif
                            <input type="hidden" name="test_id" value="{{$test->id}}">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                @if(AUTH::USER()->id==$test->user_id )
                                    <div class="dGPD2Btn"><button disabled class="btn btnMain btnMainFull"  title="you can't sign up to your own test">Sign-up</button></div>
                                @elseif(\App\Models\testapps::where('user_id',Auth::user()->id)->where('tests_id',$test->id)->exists())
                                    <div class="dGPD2Btn"><button disabled class="btn btnMain btnMainFull" >Signed-up</button></div>
                                @else
                                    <div class="dGPD2Btn"><button  class="btn btnMain btnMainFull" type="submit" >Sign-up</button></div>
                                @endif
                            @else
                                <div class="dGPD2Btn"><button  class="btn btnMain btnMainFull" type="submit" >Sign-up</button></div>
                            @endif


                        </form>

                        <div class="dGPD2Reward">
                            <p class="paraDGPD2R">Reward pool:<span class="paraDGPD2R paraDGPD2R2">{{$test->rewardpool}}</span></p>
                            <p class="paraDGPD2R">Test status:<span class="paraDGPD2R paraDGPD2R2">{{$test->test_status}}</span></p>
                            <p class="paraDGPD2R">Test version:<span class="paraDGPD2R paraDGPD2R2">{{$test->version}}</span></p>
                            <p class="paraDGPD2R">Platform:<span class="paraDGPD2R paraDGPD2R2">{{$test->platform->name}}</span></p>
                            <div class="dDGPDGenres">
                                <p class="paraDGPD2R">Genres:</p>
                                <div class="dDGPDG">
                                    @foreach($genres as $genre)
                                        <a class="linkDDGPDG" href="/tests?genre={{$genre}}">{{$genre}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="dGP"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

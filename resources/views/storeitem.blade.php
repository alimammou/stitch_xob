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
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>   @endif
    </x-slot>

    <div class="divMainContent">

        <div class="divCustomContainer">
            <div class="divPageTitleMain divTitleGamePage">
                <h1 class="headingPageTitleMain">{{$test->title}}</h1>
            </div>
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
                        <p class="paraGPD">{!! nl2br( $test->description)!!}</p>
                    </div>
                </div>
                <div class="dGP dGPRight">
                    <div class="dGPThumbnail"><img class="imgGPT" src="{{asset($test->pathtothumbnail)}}"></div>
                    <div class="dGPDetails2">

                        <form action="/store/{{$test->id}}" method="POST">
                            @csrf
                            <input type="hidden" name="storeitem_id" value="{{$test->id}}">
                            @if($test->num==0)
                        <div class="dGPD2Btn"><button disabled class="btn btnMain btnMainFull" title="out of stock"><span class="dGPD2BtnSpan">Get for:&nbsp;</span>{{$test->price*10*$price->rate}}</button></div>
                             @else
                                <div class="dGPD2Btn"><button  class="btn btnMain btnMainFull" type="submit"><span class="dGPD2BtnSpan">Get for:&nbsp;</span>{{$test->price*10*$price->rate}}</button></div>
                            @endif
                        </form>
                        <div class="dGPD2Reward">
                            <p class="paraDGPD2R">Developer:<span class="paraDGPD2R paraDGPD2R2">{{$test->developer}}</span></p>
                            <p class="paraDGPD2R">Publisher:<span class="paraDGPD2R paraDGPD2R2">{{$test->publisher}}</span></p>
                            <p class="paraDGPD2R">Platform:<span class="paraDGPD2R paraDGPD2R2">{{$test->platform->name}}</span></p>
                            <p class="paraDGPD2R">Redeemable on:<span class="paraDGPD2R paraDGPD2R2">{{$test->redeemableon}}</span></p>
                            <div class="dDGPDGenres">
                                <p class="paraDGPD2R">Genres:</p>
                                <div class="dDGPDG">
                                @foreach($genres as $genre)
                                    <a class="linkDDGPDG" href="searchGenreResults.html">{{$genre}}</a>
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
    <div id="NotificationModal" class="divModalNotification" style="display: none;">
        <div class="divCustomContainer">
            <div class="divMN">
                <div class="dMNCard">
                    <div class="dMNCTop">
                        <p class="dMNCTPara">NOTICE</p><button class="btn dMNCTBtnClose" type="button"><i class="fa fa-close"></i></button>
                    </div>
                    <div class="dMNCContent">
                        <p class="dMNCCPara">Are you sure you'd want to purchase this game?</p><button class="btn btnMain btnMainFull" type="button">Confirm purchase</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

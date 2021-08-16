<x-app-layout>
    <x-slot name="header">

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

    </x-slot>
    <div class="divMainSec dMSNoPad">
        <div class="divCustomContainer">
            <div class="divPageTitleMain">
                <h2 class="headingPageTitleMain">Dashboard</h2>
            </div>
            <div class="divDashboardDevOrTester"><a class="linkDOOT linkDOOTActive" href="#">Developer</a><a class="linkDOOT" href="/dashboard/tester">Tester</a></div>
            <div class="divDashboard">
                <div class="divDTabsHolder">
                    <div class="divDashboardPoints">
                        <p class="paraDPNote">As a&nbsp;<span class="spanPDPN">developer</span>, you have:</p>
                        <p class="paraDashboardPoints"><span class="spanDP">{{Auth::User()->points}}</span>&nbsp;of usable points.</p>
                        <p class="paraDashboardPoints"><span class="spanDP">{{$points}}</span>&nbsp;of locked to tests.</p>
                    </div>
                    <div class="divDTabs"><a class="linkDT linkDTActive" href="/">Manage tests</a><a class="linkDT" href="/dashboard/purchasepoints">Purchase points</a></div>
                </div>
                <div class="divDContentHolder">
                    <div class="divDContent">
                        <div class="divDCAdd"><a class="btn btnDCA" role="button" href="/createtest">Create new test</a></div>
                        <div class="divDCGrid">
                        @foreach($tests as $test)
                            <div class="divGMCard dGMCDa    ">
                                <div class="divGMCImg"><img class="imgGMCI" src="{{asset($test->pathtothumbnail)}}"></div>
                                <div class="divGMContent">
                                    <h5 class="headingGMC">{{$test->title}}</h5>

                                    <div class="divGMCDetails"><i class="{{$test->platform->class}} iconGMCD"></i></div>

                                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="/tests/{{$test->id}}/manage">Manage</a><a class="btn btnDGMC" role="button" href="tests/{{$test->id}}">Visit</a></div>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        {{$tests->links('layouts.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>


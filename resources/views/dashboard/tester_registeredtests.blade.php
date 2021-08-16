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

    <div class="divMainContent">
    <div class="divMainSec dMSNoPad">
        <div class="divCustomContainer">
            <div class="divPageTitleMain">
                <h2 class="headingPageTitleMain">Dashboard</h2>
            </div>
            <div class="divDashboard">
                <div class="divDTabsHolder">
                    <div class="divDashboardPoints">
                        <p class="paraDPNote">As a&nbsp;<span class="spanPDPN">Tester</span>, you have:</p>
                        <p class="paraDashboardPoints"><span class="spanDP">{{\Illuminate\Support\Facades\Auth::user()->tester_points}}</span>&nbsp;of spendable points</p>
                    </div>
                    <div class="divDTabs"><a class="linkDT linkDTActive" href="#">Registered tests</a><a class="linkDT" href="/dashboard/storepurchases">Store purchases</a></div>
                </div>
                <div class="divDContentHolder">
                    <div class="divDContent">
                        @if(count($tests)!=0)
                        <div class="divDCGrid">
                                @foreach($tests as $test)
                                    @if($test->tests)
                                    <div class="divGMCard dGMCDa    ">
                                        <div class="divGMCImg"><img class="imgGMCI" src="{{asset($test->tests->pathtothumbnail)}}"></div>
                                        <div class="divGMContent">
                                            <h5 class="headingGMC">{{$test->tests->title}}</h5>

                                            <div class="divGMCDetails"><i class="{{$test->tests->platform->class}} iconGMCD"></i></div>

                                            <div class="divBtnGMC"><a class="btn btnDGMC @if(!$test->invited_on) btnDGMCNotInvited" title="you have not been invitedd yet"  @else" href="/tests/{{$test->tests->id}}/tester" @endif role="button">Manage</a><a class="btn btnDGMC" role="button" href="tests/{{$test->tests->id}}">Visit</a></div>
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                        </div>

                        {{$tests->links('layouts.pagination')}}
                    </div>
                </div>
                    @else
                </div>
                <div class="divDashboardTesterEmptyRegisters">
                    <p class="dDTERPara">You have not registered for any tests yet.</p>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

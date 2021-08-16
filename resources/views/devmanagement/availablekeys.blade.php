<x-app-layout>
    <x-slot name="header">

        <li class="nav-item navItem nIUser" id="showThisOnceLoggedIn">
            <div class="nav-item dropdown DDNavItem"><a class="dropdown-toggle linkDLUserNav" aria-expanded="false" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu menuDL">
                    <div class="divUserInfoNav">
                        <p class="dUINPara">Rank:&nbsp;<span class="dUINPSpan">Bronze</span></p>
                    </div><a class="dropdown-item mDLItem" href="/account">Account</a>
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

                    <h2 class="headingPageTitleMain">Managing:&nbsp;<span class="spanPageTitleMain">{{$test->title}}</span></h2>
                </div>
                <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
                <div class="divDashboard DDManageTest">
                    <div class="divDTabsHolder">
                        <div class="divDTabs"><a class="linkDT" href="/tests/{{$test->id}}/manage">Edit Test</a><a class="linkDT linkDTActive" href="/tests/{{$test->id}}/keysinvites">Keys &amp; Invites</a><a class="linkDT" href="/tests/{{$test->id}}/forms">Feedback Forms</a><a class="linkDT" href="/tests/{{$test->id}}/bugreports">Bug Reports</a><a class="linkDT " href="/tests/{{$test->id}}/nda">NDA</a></div>
                        <div class="divDOther">
                            <p class="divDOPara">Remaining points:&nbsp;<span class="divDOPSpan">{{$test->remaining_points}}</span></p>
                        </div>
                        <div class="divDOther"><a class="btn btnMain btnMainFull btnMainFullLighter btnMainFullLighter" role="button" href="/tests/{{$test->id}}/delete">Delete test</a></div>
                    </div>

                    <div class="divDContentHolder">
                        <div class="divDContent DDC">
                            <div class="DDCNav DDCNKeysInvites"><a class="linkDDCN LDDCNActive" href="#">Available Keys</a><a class="linkDDCN" href="/tests/{{$test->id}}/distribution">Distribution</a></div>
                        </div>
                        <div class="DDCInfoHolder">
                            <div class="DDCInfo">
                                <p class="DDCIPara">All keys:&nbsp;<span>{{$test->gamecodes_count}}</span></p>
                                <p class="DDCIPara">Remaining keys:&nbsp;<span>{{$test->not_sent}}</span></p>
                            </div>
                            <div class="DDCIHDivider"></div>
                            <div class="DDCInfo">
                                <p class="DDCIPara">Total sign-ups:&nbsp;<span>{{$test->testapps_count}}</span></p>
                                <p class="DDCIPara">Invited testers:&nbsp;<span>{{$test->invited}}</span></p>
                                <p class="DDCIPara">Claimed keys:&nbsp;<span>{{$test->claimed_keys}}</span></p>
                            </div>
                        </div>
                        <div class="DDCAvailableKeys">
                            <div class="DDCAKButton"><a class="btn btnMain btnMainFull btnMainFullLighter" role="button" href="/tests/{{$test->id}}/addkeys">Add keys</a></div>
                            <div class="DDCAKTable">
                                <div class="DDCAKTableTop">
                                    <div class="DDCAKTTTab DDCAKTTTabFullMobile">
                                        <p class="DDCAKTTTPara">Key</p>
                                    </div>
                                    <div class="DDCAKTTTab">
                                        <p class="DDCAKTTTPara">Sent on</p>
                                    </div>
                                    <div class="DDCAKTTTab">
                                        <p class="DDCAKTTTPara">NDA</p>
                                    </div>
                                    <div class="DDCAKTTTab">
                                        <p class="DDCAKTTTPara">Forms filled</p>
                                    </div>
                                    <div class="DDCAKTTTab">
                                        <p class="DDCAKTTTPara">Bugs sent</p>
                                    </div>
                                    <div class="DDCAKTTTab DDCAKTTTabFullMobile">
                                        <p class="DDCAKTTTPara">Action</p>
                                    </div>
                                </div>

                                <div class="DDCAKTableBottom">
                                    @foreach($testers as $tester)
                                        <div class="DDCAKItem">

                                            <p class="DDCAKIPara DDCAKIParaFull">{{$tester->gamecodes->code}}</p>
                                            <p class="DDCAKIPara">{{$tester->invited_on->toDateString()}}</p>
                                            @if($tester->nda_text)
                                                @if($tester->approved==1)
                                                    <p class="DDCAKIPara">Accepted</p>
                                                    <p class="DDCAKIPara"><span class="DDCAKIPSpan">{{$tester->submissions_count}}</span>&nbsp;/&nbsp;<span class="DDCAKIPSpan">{{$test->forms_count}}</span></p>
                                                    <p class="DDCAKIPara">{{$tester->bugs_count}}</p>
                                                    <div class="DDCAKIBtnHolder DDCAKIParaFull"></div>
                                                @else
                                                    <p class="DDCAKIPara">Unknown</p>
                                                    <p class="DDCAKIPara"><span class="DDCAKIPSpan">{{$tester->submissions_count}}</span>&nbsp;/&nbsp;<span class="DDCAKIPSpan">{{$test->forms_count}}</span></p>
                                                    <p class="DDCAKIPara">{{$tester->bugs_count}}</p>
                                                <form action="/tests/{{$test->id}}/revokeinvite/{{$tester->id}}" method="post">
                                                    @csrf
                                                    <div class="DDCAKIBtnHolder DDCAKIParaFull"><button class="btn btnMain btnMainFull btnMainFullLighter" type="submit">Revoke Invite</button></div>
                                                </form>
                                                @endif
                                            @else
                                                <p class="DDCAKIPara">NA</p>
                                                <p class="DDCAKIPara"><span class="DDCAKIPSpan">{{$tester->submissions_count}}</span>&nbsp;/&nbsp;<span class="DDCAKIPSpan">{{$test->forms_count}}</span></p>
                                                <p class="DDCAKIPara">{{$tester->bugs_count}}</p>
                                                <div class="DDCAKIBtnHolder DDCAKIParaFull"></div>

                                            @endif

                                        </div>
                                    @endforeach
                                    @foreach($codes as $code)
                                            <div class="DDCAKItem">
                                                <p class="DDCAKIPara DDCAKIParaFull">{{$code->code}}</p>
                                                <p class="DDCAKIPara">-</p>
                                                <p class="DDCAKIPara">-</p>
                                                <p class="DDCAKIPara">-</p>
                                                <p class="DDCAKIPara">-</p>
                                                <form action="/tests/{{$test->id}}/deletecode/{{$code->id}}" method="post">
                                                    @csrf
                                                <div class="DDCAKIBtnHolder DDCAKIParaFull"><button class="btn btnMain btnMainFull btnMainFullLighter" type="submit">Remove key</button></div>
                                                </form></div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                        {{  $testers->links('layouts.pagination')}}
                    </div>

                </div>
            </div>
        </div>
    </div>



    </x-app-layout>

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
            <h2 class="headingPageTitleMain DDBGNHeading">Managing:&nbsp;<span class="spanPageTitleMain DDBGNHSpan">{{$test->title}}</span></h2>
        </div>
        <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
        <div class="divDashboard">
            <div class="divDTabsHolder">
                <div class="divDTabs"><a class="linkDT linkDT linkDTActive" href="#">Invite Details</a><a class="linkDT" href="/tests/{{$test->id}}/myforms">Feedback forms</a><a class="linkDT" href="/tests/{{$test->id}}/myreports">Bug reports</a></div>
            </div>
            <div class="divDContentHolder">
                <div class="divDContent">
                    <div class="dDCGridList">
                        <div class="DDCSPCardHolder">
                            <div class="DDCSPDetailsHolder">
                                <div class="DDCSPDetails DDCSPDTop">
                                    <p class="DDCSPDPara">Test key:&nbsp;</p>
                                </div>
                            </div>
                            <div class="DDCSPCard">
                                <p class="DDCSPCPara">{{$tester->gamecodes->code}}</p><button class="btn btnMain DDCSPCBtn" type="button"><i class="fas fa-copy DDCSPCBIcon"></i></button>
                            </div>
                            <div class="DDCSPDetailsHolder">
                                <div class="DDCSPDetails">
                                    <p class="DDCSPDPara">Redeemable on:&nbsp;<span class="DDCSPDPSpan">{{$test->platform->name}}</span></p>
                                    <p class="DDCSPDPara">Received on:&nbsp;<span class="DDCSPDPSpan">{{$tester->invited_on}}</span></p>
                                </div>
                            </div>
                        </div>
                        @if($tester->nda_text)
                        <div class="dDCNDADone">
                            <p class="dDCNDADPara">The NDA that you agreed to:</p>
                            <div class="dDCNDADText">
                                <p class="dDCNDADTPara">{{$tester->nda_text}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    </x-app-layout>

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
                <h2 class="headingPageTitleMain DDBGNHeading">Non-Discloure Agreement:&nbsp;<span class="spanPageTitleMain DDBGNHSpan">{{$test->title}}</span></h2>
            </div>
            <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
            <div class="dCCNDAText">
                <p class="dCCNDATPara">{{$test->nda->nda}}</p>
            </div>
            <div class="dCCNDAButtons">
                <form action="/tests/{{$test->id}}/acceptnda" method="POST">
                    @csrf
                <button class="btn btnMain btnMainFull" role="submit" href="">Accept</button>
                </form>
                <form action="/tests/{{$test->id}}/rejectnda" method="POST">
                    @csrf
                <button class="btn btnMain btnMainFull btnMainFullRed" role="submit" href="">Reject</button>
                </form>
            </div>
        </div>
    </div>
    </div>


    </x-app-layout>

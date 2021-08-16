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
                <h2 class="headingPageTitleMain"><strong>Managing</strong>:&nbsp;<span class="spanPageTitleMain">{{$test->title}}</span></h2>
            </div>
            <form action="/tests/{{$test->id}}/delete" method="post" style="width:100%;">
                @csrf
            <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>

            <div class="divBlackDashboardTextFull">
                <h1 class="dBDTFHead">Are you sure you want to delete this test?</h1>
                <p class="dBDTFPara">Be careful. Delete this test means that all of your sign-ups will be deleted, alongside any submitted feedback forms and bug reports.<br>(This action will also unlock any points within this test and move it back to your account.)</p>

                <div class="dBDTFBtn"><button class="btn btnMain btnMainFull btnMainFullLighter btnMainFullRed" type="submit">Yes. Delete this test.</button></div>

            </div>
            </form>
        </div>

    </div>

    </x-app-layout>

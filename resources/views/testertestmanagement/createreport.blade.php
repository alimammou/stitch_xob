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
            <div class="divDashboardBack"><a class="linkDB" href="/tests/{{$test->id}}/tester">Back to game management</a></div>
            <div class="divCreateBugReport">
                <div class="dFFContentHolder">
                    <div class="dFFContent">
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/tests/{{$test->id}}/myreports/create" method="post">
                            @csrf
                        <h4 class="dFFCHeading">Bug report title</h4>
                        <div class="dFFCQuestions">
                            <div class="dFFCQHold"><label class="labelMain dFFCQLabel">Bug report title</label><input type="text" name="title" class="inputMain" required></div>
                            <div class="dFFCQHold"><label class="labelMain dFFCQLabel">Bug report message</label><textarea class="inputMain" name="bug_report"required></textarea></div>
                            <div class="dFFCQHold"><label class="labelMain dFFCQLabel">Steps to reproduce bug</label><textarea class="inputMain"name="steps_to_reproduce" required></textarea></div>
                        </div>
                            <div class="dFFCBtn"><button class="btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </x-app-layout>

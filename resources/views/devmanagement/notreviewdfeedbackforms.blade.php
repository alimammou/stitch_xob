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
                        <div class="divDTabs"><a class="linkDT " href="/tests/{{$test->id}}/manage">Edit Test</a><a class="linkDT" href="/tests/{{$test->id}}/keysinvites">Keys &amp; Invites</a><a class="linkDT linkDTActive" href="/tests/{{$test->id}}/forms">Feedback Forms</a><a class="linkDT" href="/tests/{{$test->id}}/bugreports">Bug Reports</a><a class="linkDT " href="/tests/{{$test->id}}/nda">NDA</a></div>
                        <div class="divDOther">
                            <p class="divDOPara">Remaining points:&nbsp;<span class="divDOPSpan">{{$test->remaining_points}}</span></p>
                        </div>
                        <div class="divDOther"><a class="btn btnMain btnMainFull btnMainFullLighter btnMainFullLighter" role="button" href="/tests/{{$test->id}}/delete">Delete test</a></div>
                    </div>
                    <div class="divDContentHolder">
                        <div class="DDCNav"><a class="linkDDCN LDDCNActive" href="#">Feedback submissions</a><a class="linkDDCN" href="/tests/{{$test->id}}/forms/{{$form->id}}/reviewed">Reviewed submissions</a></div>
                        <div class="DDCFFBlank">
                            <div class="DDCFFBGridList">
                                @foreach($submissions as $submission)
                                <div class="DDCFFBGLFeedbackUser">
                                    <div class="DDCFFBGLFUPara">
                                        <p class="DDCFFBGLFUP">{{$submission->created_at->toDateString()}}</p>
                                    </div>
                                    <div class="DDCFFBGLFUButtons"><a class="DDCFFBGLFUBLink" href="/tests/{{$test->id}}/forms/{{$form->id}}/submissions/{{$submission->id}}">Review</a></div>
                                </div>
                                @endforeach
                        </div>
                        </div>
                        {{  $submissions->links('layouts.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>



    </x-app-layout>

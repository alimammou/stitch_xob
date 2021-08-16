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
            <div class="divFeedbackForm">
                <div class="dFFNotesHolder">
                    @if($bug->status=="new")
                    <div class="dFFNotes">
                        <p class="dFFNPara">Status:&nbsp;<span class="dFFNPSpan">Pending review</span></p>
                        <p class="dFFNPara">Score:&nbsp;<span class="dFFNPSpan">NA</span></p>
                        <p class="dFFNPara">Reward:&nbsp;<span class="dFFNPSpan">Yet to be rewarded</span></p>
                    </div>
                    @else
                        <div class="dFFNotes">
                            <p class="dFFNPara">Status:&nbsp;<span class="dFFNPSpan">Reviewed</span></p>
                            <p class="dFFNPara">Score:&nbsp;<span class="dFFNPSpan">{{$bug->score}}/3</span></p>
                            <p class="dFFNPara">Reward:&nbsp;<span class="dFFNPSpan">{{$bug->reward}}</span></p>
                        </div>
                    @endif
                </div>
                <div class="dFFContentHolder">
                    <div class="dFFContent">
                        <h4 class="dFFCHeading">{{$bug->title}}</h4>
                        <div class="divBugReportView">
                            <div class="dBRV">
                                <p class="dBRVParaLabel">Bug message</p>
                                <p class="dBRVPara">{{$bug->bug}}</p>
                            </div>
                            <div class="dBRV">
                                <p class="dBRVParaLabel">Steps to reproduce bug</p>
                                <p class="dBRVPara">{{$bug->stepsto}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

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
                <h2 class="headingPageTitleMain DDBGNHeading">Managing:&nbsp;<span class="spanPageTitleMain DDBGNHSpan">Game Title</span></h2>
            </div>
            <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
            <div class="divDashboard">
                <div class="divDTabsHolder">
                    <div class="divDTabs"><a class="linkDT linkDT" href="/tests/{{$test->id}}/tester">Invite Details</a><a class="linkDT linkDTActive" href="#">Feedback forms</a><a class="linkDT" href="/tests/{{$test->id}}/myreports">Bug reports</a></div>
                </div>
                <div class="divDContentHolder">
                    <div class="divDContent">
                        <div class="dDCGridList">
                            @if($form)
                            <div class="dDCGLCard dDCGLCActive">
                                <p class="dDCGLCPara">{{$form->name}}</p>
                                <div class="dDCGLCBtns"><a class="btn btnMain dDCGLCB" role="button" href="/tests/{{$test->id}}/myforms/{{$form->id}}"><i class="fas fa-pencil-alt dDCGLCBIcon"></i></a></div>
                            </div>
                            @endif
                            @foreach($submissions as $submission)
                                @if($submission->form_id==$form->id)
                                    @else
                                    <div class="dDCGLCard ">
                                        <p class="dDCGLCPara">{{$submission->created_at->toDateString()}}</p>
                                        <div class="dDCGLCBtns"><a class="btn btnMain dDCGLCB" role="button" href="/tests/{{$test->id}}/myforms/{{$submission->id}}/mysubmission"><i class="fas fa-pencil-alt dDCGLCBIcon"></i></a></div>
                                    </div>
                                    @endif
                                @endforeach
                        </div>
                        {{$submissions->links('layouts.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

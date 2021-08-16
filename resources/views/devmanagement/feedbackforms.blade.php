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
                        <div class="DDCFFBlank">
                            <div class="DDCFFCreateBtn"><a class="btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" role="button" href="/tests/{{$test->id}}/createform">Create form</a></div>
                            <div class="DDCFFList">
                                @foreach($forms as $form)
                                <div class="DDCFFLItem">
                                    <div class="DDCFFLIPara">
                                        <p class="DDCFFLIP">{{$form->name}}</p>
                                    </div>
                                    <div class="DDCFFLIButtons"><form action="/tests/{{$test->id}}/forms/{{$form->id}}/delete" method="post">@csrf<button class="btn DDCFFLIBLink DDCFFLIBLRed" type="submit"><i class="fas fa-trash"></i></button></form><a class="DDCFFLIBLink" href="/tests/{{$test->id}}/forms/{{$form->id}}/view" ><i class="far fa-eye"></i></a><a class="DDCFFLIBLink" href="/tests/{{$test->id}}/forms/{{$form->id}}"><i class="fas fa-inbox"></i></a>@if($form->active==1)<a class="DDCFFLIBLink DDCFFLIBLActive" href="#"><i class="fas fa-check"></i></a>@else<form action="/tests/{{$test->id}}/forms/{{$form->id}}/setactive" method="post">@csrf<button class="btn DDCFFLIBLink" type="submit"><i class="fas fa-check"></i></button></form>@endif</div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        {{  $forms->links('layouts.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>




    </x-app-layout>

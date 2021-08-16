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
                <h2 class="headingPageTitleMain">Managing:&nbsp;<span class="spanPageTitleMain">{{$test->title}}</span></h2>
            </div>
            <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
            <div class="divDashboard DDManageTest">
                <div class="divDTabsHolder">
                    <div class="divDTabs"><a class="linkDT" href="/tests/{{$test->id}}/manage">Edit Test</a><a class="linkDT" href="/tests/{{$test->id}}/keysinvites">Keys &amp; Invites</a><a class="linkDT" href="/tests/{{$test->id}}/forms">Feedback Forms</a><a class="linkDT" href="/tests/{{$test->id}}/bugreports">Bug Reports</a><a class="linkDT linkDTActive" href="/tests/{{$test->id}}/nda">NDA</a></div>
                    <div class="divDOther">
                        <p class="divDOPara">Remaining points:&nbsp;<span class="divDOPSpan">{{$test->remaining_points}}</span></p>
                    </div>
                    <div class="divDOther"><a class="btn btnMain btnMainFull btnMainFullLighter btnMainFullLighter" role="button" href="/tests/{{$test->id}}/delete">Delete test</a></div>
                </div>
                <div class="divDContentHolder">
                    <div class="divDContent DDC">
                        <div class="DDCNDA">
                            @if ($errors->any())
                                <div>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="/tests/{{$test->id}}/nda" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$test->id}}">
                            <div class="DDCNDAText"><label class="labelMain">Non-Disclosure Agreement (NDA)</label><textarea class="inputMain"name="nda"></textarea></div>
                            <div class="divNDAToggle"><label class="labelMain">Require this NDA to be accepted by the tester, for them to receive their access key or link.</label><select class="custom-select inputMain"name="required">
                                    <optgroup label="Game Test NDA" class="optgroupIDANGF">
                                        <option value="0" selected="">Disable</option>
                                        <option value="1">Enable</option>
                                    </optgroup>
                                </select></div>
                            <div class="divNDATimeLimit"><label class="labelMain">Recall time-limit</label>
                                <p class="paraNDATL">The test invite will be unsent if the tester rejects the NDA, or if they don't respond after the specified time limit.</p><select class="custom-select inputMain" name="timelimit">
                                    <optgroup label="Game Test NDA Time Limit" class="optgroupIDANGF">
                                        <option value="NULL" selected="">No limit</option>
                                        <option value="1">24 Hours</option>
                                        <option value="14">14 Days</option>
                                        <option value="30">30 Days</option>
                                        <option value="90">90 Days</option>
                                        <option value="365">365 Days</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="divNDABtn"><button class="btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" type="submit">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>

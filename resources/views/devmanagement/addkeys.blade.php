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
    <div class="divMainContent">
        <div class="divMainSec dMSNoPad">
            <div class="divCustomContainer">
                <div class="divPageTitleMain">
                    <h2 class="headingPageTitleMain"><strong>Managing</strong>:&nbsp;<span class="spanPageTitleMain">{{$test->title}}</span></h2>
                </div>
                <div class="divDashboardBack"><a class="linkDB" href="/tests/{{$test->id}}/keysinvites">Back to keys and invites</a></div>

                <div class="dCCAddKeys">
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/tests/{{$test->id}}/addkeys" method="POST">
                        @csrf
                        <input type="hidden" name="test_id" value="{{$test->id}}">
                    <div class="dCCAK"><label class="labelMain">Add your keys here</label><textarea name="code" class="inputMain iMAddKeys"></textarea><button class="btn btnMain btnMainFull btnMainFullLighter" type="submit">Add keys</button></div>
                    </form>
                    <div class="dCCAK">
                        <p class="dCCAKPara">Make sure to seperate each unique key with a new line.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>



</x-app-layout>

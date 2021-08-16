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
        <div class="divCustomContainer">
            <div class="divPageTitleMain">
                <h2 class="headingPageTitleMain">Account</h2>
            </div>
            <div class="divAccount">
                <div class="dAMenu">
                    <div class="dAMHolder"><a class="linkDAMH" href="/account">General</a><a class="linkDAMH" href="/account/email">Email</a><a class="linkDAMH LDAMHActive" href="#">Password</a></div>
                </div>
                <div class="dAContent">
                    <form action="/account/password" method="post" class="dACHolder">
                        @csrf
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div  class="dACHGeneral">
                            <div class="DACHGField"><label class="labelMain">Old password</label><input type="password" class="inputMain" name="current_password" placeholder="Type your old password.." required=""></div>
                            <div class="DACHGField"><label class="labelMain">New password</label><input type="password" class="inputMain" name="password" placeholder="Type your new password.." required=""></div>
                            <div class="DACHGField"><label class="labelMain">Re-type new password</label><input type="password" name="password_confirmation" class="inputMain" placeholder="Re-type your new password.." required=""></div>
                        </div>
                        <div class="dACHGBtn"><button class="btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" type="submit">Save</button></div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

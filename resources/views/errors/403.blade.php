<x-app-layout>
    <x-slot name="header">
        @if(Auth::check())

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

        @else
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>   @endif
    </x-slot>
    <div class="divCustomContainer">
        <div class="divPageTitleMain">
            <h2 class="headingPageTitleMain">Seems like you got a <span class="spanHPTM">403</span>&nbsp;error</h2>
        </div>
        <div class="divWallText">
            <p class="paraWT">Hey there,<br><br>It seems like you're trying to access a page you're not allowed to.</p>
        </div>
    </div>



</x-app-layout>

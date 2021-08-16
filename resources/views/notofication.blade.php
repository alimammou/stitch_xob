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

    <div class="divCustomContainer">
        <h3 class="headingNotification">Notifications</h3>
        <div class="divNotification">
            @foreach($notifications as $notification)
            <div class="dNItem">
                <div class="dNITop">
                    <p class="dNITPara">{{$notification->text}}</p>
                    <p class="dNITPara dNITPDateTime">{{$notification->created_at->toDateString()}}<span class="dNITPDateTimeSpan">{{$notification->created_at->toTimeString()}}</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
    </x-app-layout>

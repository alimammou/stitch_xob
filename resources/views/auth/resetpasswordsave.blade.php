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
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>    @endif
    </x-slot>

    <div class="divMainContent">
        <div class="divCustomContainer">
            <div class="divResetPassword">
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="/reset-password" method="post">
                    @csrf
                    <input hidden name="token" value="{{request()->route('token')}}">
                    <div class="dRP"><label class="labelMain">Type your email/label><input type="text" name="email" class="inputMain" placeholder="Your email address.."></div>
                <div class="dRP"><label class="labelMain">Type your new password</label><input name="password" type="password" class="inputMain" placeholder="New password.."></div>
                <div class="dRP"><label class="labelMain">Re-type your new password</label><input name="password_confirmation" type="password" class="inputMain" placeholder="Re-type your new password.."></div>
                <div class="dRPBtn"><button class="btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" type="submit">Save new password</button></div>
                </form>
            </div>
        </div>
    </div>



    </x-app-layout>

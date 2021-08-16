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
    <div class="divMainContent">

        <div class="divCustomContainer">
            <div class="divLogin">
                    <div class="dLTop"><a class="dLTLink" href="/register">Register</a><a class="dLTLink dLTLActive" href="">Login</a></div>
                <div class="dLBottom">
                    <form action="/login" method="post" class="dLB">
                        @if ($errors->any())
                            <div>
                                    @foreach($errors->all() as $error)
                                        <p style="text-align: center;margin: 0;color: tomato;">{{$error}}</p>
                                    @endforeach
                            </div>
                        @endif

                            @csrf
                            <div class="dTLTCTP"><label class="labelMain">Email</label><input type="email" class="inputMain" name="email"></div>
                            <div class="dTLTCTP"><label class="labelMain">Password</label><input type="password" class="inputMain"name="password"></div>
                            <div> <label for="remember">
                                    <input id="remember" type="checkbox" name="remember">
                                    remember me
                                </label></div>
                            <p class="paraDTLTCTP">Forgot your password?&nbsp;<a class="linkPDTLTCTP" href="/forgot-password">Reset password.</a></p>
                            <button class="divRegisterLoginBtn btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" role="button"name="Login">Login</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>

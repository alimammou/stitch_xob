<x-app-layout>
    <x-slot name="header">
        @if(Auth::check())

            <li class="nav-item navItem nIUser" id="showThisOnceLoggedIn">
                <div class="nav-item dropdown DDNavItem"><a class="dropdown-toggle linkDLUserNav" aria-expanded="false" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu menuDL">
                        <div class="divUserInfoNav">
                            <p class="dUINPara">Rank:&nbsp;<span class="dUINPSpan">Bronze</span></p>
                        </div><a class="dropdown-item mDLItem" href="/account">Account</a>
                        <a class="dropdown-item mDLItem" href="/notification">Notifications</a>
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
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>     @endif
    </x-slot>

    <div class="divMainContent">
        <div class="divCustomContainer">

            <div class="divLogin">
                <div class="dLRegistrationTitle">
                    <h3 class="text-center dLRTHeading">Email verification</h3>
                </div>
                <div class="dLBottom">
                    <div class="dLB">
                        <div class="dLBRegister">
                            <p class="dLBR">We've sent you a link to the below email that you need to click in-order to complete your registration.</p>
                            <p class="dLBR" style="margin: 5px 0 0 0;color: grey;">Mistyped your email? You can correct it below and resend the verification email.</p>
                        </div>
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/email/verify" method="post" class="dLB">

                            @csrf
                        <div class="dTLTCTP"><label class="labelMain">Email</label><input type="email" name="email" class="inputMain" required="" value="{{Auth::User()->email}}"></div>
                        <div class="dTLTCTP"><label class="labelMain">Password</label><input type="password" name="current_password" class="inputMain" required="" placeholder="Your password.."></div>
                            <button class="divRegisterLoginBtn btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" role="button">Re-send verification</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>




</x-app-layout>

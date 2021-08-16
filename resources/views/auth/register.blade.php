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
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>
        @endif
    </x-slot>
    <div class="divMainContent">
        <div class="divLogin">
            <div class="dLTop"><a class="dLTLink dLTLActive" href="#">Register</a><a class="dLTLink" href="/login">Login</a></div>
            <div class="dLBottom">
                <form action="/register" method="post" class="dLB">
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                            @csrf
                        <div class="dTLTCTP"><label class="labelMain">user name</label><input type="text" class="inputMain" required="" name="name" value="{{old('name')}}" autofocus></div>
                        <div class="dTLTCTP"><label class="labelMain">email</label><input type="email" class="inputMain" required="" name="email"value="{{old('email')}}"></div>
                        <div class="dTLTCTP"><label class="labelMain">Password</label><input type="password" class="inputMain" required="" name="password"></div>
                        <div class="dTLTCTP"><label class="labelMain">Type your password again</label><input type="password" class="inputMain" required=""name="password_confirmation"></div>
                        <div class="dTLTCTP"><label class="labelMain">You're a..</label><select class="custom-select inputMain" id="select" type="hidden" name="role" required=""onchange="myFunction()">
                               <optgroup label="Registeration role" class="optgroupMain"onchange="this.form.submit()">
                                    <option value="1"selected >Tester</option>
                                    <option value="2">Developer</option>
                                </optgroup>
                            </select></div>
                           <div id="devfield"> </div>
                        <div class="dTLTCTP">
                            <p class="paraDTLTCTP">By creating an account you agree to our&nbsp;<a class="linkPDTLTCTP" href="termsConditions.html">Terms &amp; Conditions</a></p>
                        </div>
                            <button class="divRegisterLoginBtn btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" role="button" name="Register">Register</button>
                        </form>
                    </div>




                </div>
            </div>
        </div>
    </div>
    </x-app-layout>
<script>
    function myFunction()
    {
        var elem = document.getElementById('select');
        console.log(elem.value)
        if(elem.value==2)
        {
            var x = document.getElementById('devfield');
            var btn = document.createElement("div");
            btn.innerHTML = "<div class=\"dTLTCTP\"><label class=\"labelMain\">Developer/Studio name</label><input type=\"text\" name=\"devname\" class=\"inputMain\" required></div>";
              //  btn.className = "DDCFFQ";
            x.appendChild(btn)
               }
        else
            {
                var x = document.getElementById('devfield');
                x=x.children;
                x[0].remove();
            }
    }
</script>

<x-app-layout>
    <x-slot name="header">

        @if(Auth::check())

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

        @else
            <li class="nav-item navItem nIUser" id="removeThisOnceLoggedIn"><a class="nav-link linkNL LNLUser" href="/register">Login/Register</a></li>    @endif

    </x-slot>

    <div class="divCustomContainer">
        <form method="get" action="#" style="width: 100%">
            <div class="divPageTitleMain divMCHeading">
                <h2 class="headingPageTitleMain">Tests</h2>

                <div class="divMC dMCSearch"><input type="search" name="search" class="inputMain"value="{{request('search')}}"><button class="btn btnMain btnStoreSearch" role="submit" ><i class="fas fa-search iconBSS"></i></button></div>
            </div>
            <div class="divMCFilters">
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Platform</label><select class="custom-select inputMain" name="platform" required="">
                        <optgroup label="Game Platform" class="optgroupIDANGF">
                            <option value="" selected="">Show all</option>
                            @foreach($platforms as $platform)
                                <option value="{{$platform->id}}" @if(request('platform')==$platform->id) selected @endif >{{$platform->name}}</option>
                            @endforeach
                        </optgroup>
                    </select></div>
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">List order</label><select class="custom-select inputMain" name="order" required="">
                        <optgroup label="Game Priority Filter" class="optgroupIDANGF">
                            <option value="">Newest</option>
                            <option value="2" @if(request('order')=="2") selected @endif >Oldest</option>
                            <option value="3" @if(request('order')=="3") selected @endif>Most popular</option>
                        </optgroup>
                    </select></div>
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Genre</label><select class="custom-select inputMain" required="" name="genre">
                        <optgroup label="Game Genre" class="optgroupIDANGF">
                            <option  value="" selected="">Show all</option>
                            @foreach($genres as $platform)
                                <option value="{{$platform->name}}" @if(request('genre')==$platform->name) selected @endif >{{$platform->name}}</option>
                            @endforeach
                        </optgroup>
                    </select></div>
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Reward availability</label><select class="custom-select inputMain" name="reward" required="">
                        <optgroup label="Test rewards" class="optgroupIDANGF">
                            <option  value="" selected="">Show both</option>
                            <option value="1" @if(request('reward')=="1") selected @endif>Has rewards</option>
                            <option value="2" @if(request('reward')=="2") selected @endif>No rewards</option>
                        </optgroup>
                    </select></div>
            </div>
        </form>

        <div class="divGridMain">
            @foreach($tests as $test)
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="{{ $test->pathtothumbnail}}"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">{{$test->title}}</h5>

                        <div class="divGMCDetails"><i class="{{$test->platform->class}} iconGMCD"></i>@if($test->rewardpool>0)<i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i>@endif</div>

                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests/{{$test->id}}">View</a></div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
        {{$tests->links('layouts.pagination')}}



</x-app-layout>

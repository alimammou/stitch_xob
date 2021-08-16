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
                <h2 class="headingPageTitleMain">Store</h2>

                <div class="divMC dMCSearch"><input type="search" name="search" class="inputMain"value="{{request('search')}}"><button class="btn btnMain btnStoreSearch" role="submit" ><i class="fas fa-search iconBSS"></i></button></div>
            </div>
            <div class="divMCFilters">
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Platform</label><select class="custom-select inputMain" name="platform" required="">
                        <optgroup label="Game Platform" class="optgroupIDANGF">
                            <option value="" selected="">Show all</option>
                            @foreach($platforms as $platform)
                                <option value="{{$platform->id}}" @if(request('platform')==$platform->id) selected @endif>{{$platform->name}}</option>
                            @endforeach
                        </optgroup>
                    </select></div>
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Genre</label><select class="custom-select inputMain" required="" name="genre">
                        <optgroup label="Game Genre" class="optgroupIDANGF">
                            <option  value="" selected="">Show all</option>
                            @foreach($genres as $platform)
                                <option value="{{$platform->name}}" @if(request('genre')==$platform->name) selected @endif>{{$platform->name}}</option>
                            @endforeach
                        </optgroup>
                    </select></div>

            </div>
        </form>
    <div class="divGridMain">

        @foreach($storeitems as $item)
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="{{ $item->pathtothumbnail}}"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">{{$item->title}}</h5>

                    <div class="divGMCDetails"><i class="{{$item->platform->class}} iconGMCD"></i></div>

                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="store/{{$item->id}}">{{$item->price*10*$price->rate}}</a></div>
                </div>
            </div>
        @endforeach

    </div>
    {{$storeitems->links('layouts.pagination')}}
    </div>




</x-app-layout>

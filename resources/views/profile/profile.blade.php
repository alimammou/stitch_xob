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
                <div class="dAMHolder"><a class="linkDAMH LDAMHActive" href="#">General</a><a class="linkDAMH" href="/account/email">Email</a><a class="linkDAMH" href="/account/password">Password</a></div>
            </div>
            <div class="dAContent">
                <div class="dACHolder dACHInfo">
                    <div class="dACHI">
                        <p class="dACHIPara">Rank:&nbsp;<span class="dACHISpan">Gold</span></p>
                    </div>
                </div>
                <form method="post" action="/account/update" class="dACHolder">
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
                    <div class="dACHGeneral">
                        @if(\Illuminate\Support\Facades\Auth::user()->role==2)
                        <div class="DACHGField"><label class="labelMain">Developer/Studio name</label><input type="text" class="inputMain" value="{{\Illuminate\Support\Facades\Auth::user()->devname}}" disabled placeholder="Developer/Studio name"></div>
                        @endif
                        <div class="DACHGField"><label class="labelMain">Country of residency</label><select class="custom-select inputMain" required="" disabled="">
                                <optgroup label="Country of residency" class="optgroupIDANGF">
                                    <option value="{{$profile->country}}" selected="">{{$profile->country}}</option>
                                </optgroup>
                            </select></div>
                        <div class="DACHGField"><label class="labelMain">Date of birth</label><input class="inputMain" type="date" value="{{$profile->DOB->toDateString()}}" disabled readonly=""></div>
                        <div class="DACHGField"><label class="labelMain">Sex</label><select class="custom-select inputMain" required="" readonly="" disabled>
                                <optgroup label="Sex" class="optgroupIDANGF">
                                    <option value="{{$profile->gender}}" selected="">{{$profile->gender}}</option>
                                </optgroup>
                            </select></div>
                            <div class="DACHGField"><label class="labelMain">native language</label><input class="inputMain" type="text" value="{{$profile->native_language}}" disabled readonly=""></div>
                            <div class="DACHGField"><label class="labelMain">secondary language</label><input class="inputMain" type="text" value="{{$profile->secondary_language}}" disabled readonly=""></div>
                        <div class="DACHGField"><label class="labelMain">You mainly play on</label><select class="custom-select inputMain" name="platform" required="">
                                <optgroup label="Main user device" class="optgroupIDANGF">
                                    <option value="0" @if($profile->platform==0) selected @endif >Unknown</option>
                                    @foreach($p as $platform)
                                        @if($platform->id==$profile->platform)
                                            <option value="{{$platform->id}}"selected >{{$platform->name}}</option>
                                        @else
                                            <option value="{{$platform->id}}" >{{$platform->name}} </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select></div>
                        <div class="DACHGField"><label class="labelMain">Sometimes you play on</label><select name="secondary_platform" class="custom-select inputMain" required="">
                                <optgroup label="Main user device" class="optgroupIDANGF">
                                    <option value="0" @if($profile->platform==0) selected @endif>Unknown</option>
                                    @foreach($p as $platform)
                                        @if($platform->id==$profile->secondary_platform)
                                            <option value="{{$platform->id}}"selected >{{$platform->name}}</option>
                                        @else
                                            <option value="{{$platform->id}}" >{{$platform->name}} </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select></div>
                        <div class="DACHGField DACHGFBig"><label class="labelMain">Game genres (types) you like</label>
                            <div class="DACHGFCheckBoxes">
                                @foreach($genres as $genre)
                                    <div class="custom-control custom-checkbox checkboxMainDiv"><input class="custom-control-input checkboxMain" type="checkbox" id="formCheck[{{$loop->index}}]" value="{{$genre->name}}"  name="genres[]"><label class="custom-control-label checkboxMainLabel" for="formCheck[{{$loop->index}}]">{{$genre->name}}</label></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="dACHGBtn"><button class="btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" type="submit">Save</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
<script type="text/javascript">
    let genres=<?php echo json_encode($profile->genres, JSON_HEX_TAG); ?>;
    genres=JSON.parse(genres);
    elements=document.getElementsByName('genres[]');
    for(let i=0; i<genres.length;i++)
        for(let j=0; j<elements.length;j++)
        {
            if(genres[i]==elements[j].value)
                elements[j].checked = true;;
        }
</script>

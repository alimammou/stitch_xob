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
        <div class="divMainSec dMSNoPad">
            <div class="divCustomContainer">
                <div class="divPageTitleMain">
                    <h2 class="headingPageTitleMain">Managing:&nbsp;<span class="spanPageTitleMain">{{$test->title}}</span></h2>
                </div>
                <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
                <div class="divDashboard DDManageTest">
                    <div class="divDTabsHolder">
                        <div class="divDTabs"><a class="linkDT linkDTActive" href="/tests/{{$test->id}}/manage">Edit Test</a><a class="linkDT" href="/tests/{{$test->id}}/keysinvites">Keys &amp; Invites</a><a class="linkDT" href="/tests/{{$test->id}}/forms">Feedback Forms</a><a class="linkDT" href="/tests/{{$test->id}}/bugreports">Bug Reports</a><a class="linkDT " href="/tests/{{$test->id}}/nda">NDA</a></div>
                        <div class="divDOther">
                            <p class="divDOPara">Remaining points:&nbsp;<span class="divDOPSpan">{{$test->remaining_points}}</span></p>
                        </div>
                        <div class="divDOther"><a class="btn btnMain btnMainFull btnMainFullLighter btnMainFullLighter" role="button" href="/tests/{{$test->id}}/delete">Delete test</a></div>
                    </div>
                    <div>
                    <form method="POST" action="/tests/{{$test->id}}/manage"enctype="multipart/form-data">
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

                        <div class="divAddingNewGame">
                            <input type="hidden" name="test_id" value="{{$test->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <div class="divANGField"><label class="labelMain">Title</label><input type="text" class="inputMain" placeholder="Game title.." required="" name="title"VALUE="{{$test->title}}"></div>
                            <div class="divANGField"><label class="labelMain">Description</label><textarea class="inputMain" placeholder="This game is a.." name="description" required="">{{$test->description}}</textarea></div>
                            <div class="divANGField"><label class="labelMain">Thumbnail</label>
                                <p class="paraDANGF">Resolution must be: 1280x720 (Max size: 450 KB)</p>
                                @if($test->pathtothumbnail)
                                <div class="divANGFPicHolder"><img class="imgScreenshotDashboard" @if($test->pathtothumbnail) src="{{asset($test->pathtothumbnail)}}" @endif><input class="inputImageDashboardDev" type="file" accept="image/*" name="thumbnail"></div>
                                @else
                                    <input type="file" accept="image/*" name="thumbnail">

                                @endif
                            </div>
                            <div class="divANGField"><label class="labelMain">Screenshots</label>
                                <p class="paraDANGF">Resolution must be: 1280x720 (Max size: 450 KB). Maximum of 5 screenshots.</p>
                                <div class="divDashboardDevScreenshots">
                                    <div class="divANGFPicHolder"><img class="imgScreenshotDashboard"  @if($test->pathtosc1) src="{{asset($test->pathtosc1)}}" @endif><input class="inputImageDashboardDev" type="file" multiple="" accept="image/*" name="sc1">@if($test->pathtosc1)<button class="btn btnPicRemove" onclick="event.preventDefault(); document.getElementById('deletesc1').submit();" type="button"><i class="fa fa-trash"></i></button> @endif</div>
                                    <div class="divANGFPicHolder"><img class="imgScreenshotDashboard"  @if($test->pathtosc2) src="{{asset($test->pathtosc2)}}" @endif><input class="inputImageDashboardDev" type="file" multiple="" name="sc2" accept="image/*">@if($test->pathtosc2)<button class="btn btnPicRemove" onclick="event.preventDefault(); document.getElementById('deletesc2').submit();" type="button"><i class="fa fa-trash"></i></button> @endif</div>
                                    <div class="divANGFPicHolder"><img class="imgScreenshotDashboard"  @if($test->pathtosc3) src="{{asset($test->pathtosc3)}}" @endif><input class="inputImageDashboardDev" type="file" multiple="" name="sc3" accept="image/*">@if($test->pathtosc3)<button class="btn btnPicRemove" onclick="event.preventDefault(); document.getElementById('deletesc3').submit();" type="button"><i class="fa fa-trash"></i></button> @endif</div>
                                    <div class="divANGFPicHolder"><img class="imgScreenshotDashboard"  @if($test->pathtosc4) src="{{asset($test->pathtosc4)}}" @endif><input class="inputImageDashboardDev" type="file" multiple="" name="sc4" accept="image/*">@if($test->pathtosc4)<button class="btn btnPicRemove" onclick="event.preventDefault(); document.getElementById('deletesc4').submit();" type="button"><i class="fa fa-trash"></i></button> @endif</div>
                                    <div class="divANGFPicHolder"><img class="imgScreenshotDashboard"  @if($test->pathtosc5) src="{{asset($test->pathtosc5)}}" @endif><input class="inputImageDashboardDev" type="file" multiple=" "name="sc5" accept="image/*">@if($test->pathtosc5) <button class="btn btnPicRemove" onclick="event.preventDefault(); document.getElementById('deletesc5').submit();" type="button"><i class="fa fa-trash"></i></button> @endif</div>
                                </div>
                            </div>
                            <div class="divANGField"><label class="labelMain">Trailer</label>
                                <p class="paraDANGF">If available</p><input type="text" class="inputMain" placeholder="Youtube link.." inputmode="url"name="trailer"value="{{$test->trailer}}">
                            </div>
                            <div class="divANGField"><label class="labelMain">Platform</label>
                                <p class="paraDANGF">What platform are you testing on?</p><select class="custom-select inputMain" required=""name="platform_id"value="{{$test->platform}}">
                                    <optgroup label="Game test platform" class="optgroupIDANGF">
                                        @foreach($p as $platform)
                                            @if($platform->id==$test->platforms_id)
                                                <option value="{{$platform->id}}"selected >{{$platform->name}}</option>
                                            @else
                                            <option value="{{$platform->id}}" >{{$platform->name}} </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <div class="divANGField"><label class="labelMain">Genres</label>
                                <p class="paraDANGF">What genres does your game belong to?</p>
                                <div class="dropdown dropdownMultiSelectMain keep-open"><button class="btn btn-primary dropdown-toggle btnDDMSM" aria-expanded="false" data-toggle="dropdown" type="button">Genres/s</button>
                                    <div class="dropdown-menu menuDDMSM">

                                        @foreach($g as $genre)
                                            <div class="custom-control custom-checkbox checkLabelDDMSM"><input class="custom-control-input checkCLDDMSM" type="checkbox" id="formCheck[{{$loop->index}}]" name="genres[]"value="{{$genre->name}}"><label class="custom-control-label labelCLDDMSM" for="formCheck[{{$loop->index}}]">{{$genre->name}}</label></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="divANGField"><label class="labelMain">Page status</label>
                                <p class="paraDANGF">If this game test (page) will be live or not.</p><select class="custom-select inputMain" required=""name="page_status"value="{{$test->page_status}}">
                                    <optgroup label="Game test visibility" class="optgroupIDANGF">
                                        <option value="1"  @if($test->page_status==1) selected @endif >Publised</option>
                                        <option value="0"  @if($test->page_status==0) selected @endif >Draft</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="divANGField"><label class="labelMain">Tester registration</label>
                                <p class="paraDANGF">Can testers sign up for the this test?</p><select class="custom-select inputMain" required=""name="tester_registration">
                                    <optgroup label="Game test visibility" class="optgroupIDANGF">
                                        <option value="1" @if($test->tester_registration==1) selected @endif >Enabled</option>
                                        <option value="0" @if($test->tester_registration==0) selected @endif >Disabled</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="divANGField"><label class="labelMain">Reward pool</label>
                                <p class="paraDANGF">Notice: Once a single tester signs up for the test, the points that you add here cannot be removed unless you delete this test (resulting in losing your sign-up list for this test).</p><input type="number" disabled class="inputMain" placeholder="Total reward points available for this test.." inputmode="numeric"name="rewardpool" value="{{$test->rewardpool}}">

                            </div>
                            <div class="divANGField"><label class="labelMain">Add more reward to the reward pool</label>
                                <p class="paraDANGF">-</p><input type="number" name="extra_reward" class="inputMain" placeholder="Extra reward points to add.." inputmode="numeric">
                            </div>
                            <div class="divANGField"><label class="labelMain">Test version</label>
                                <p class="paraDANGF">What version of your game are you testing?</p><select class="custom-select inputMain" required=""name="version"value="{{$test->version}}">
                                    <optgroup label="Gane test versuib'" class="optgroupIDANGF">
                                        <option value="Prototype" @if($test->version=="Prototype") selected @endif>Prototype</option>
                                        <option value="Pre-Alpha" @if($test->version=="Pre-Alpha") selected @endif>Pre-Alpha</option>
                                        <option value="Alpha" @if($test->version=="Alpha") selected @endif>Alpha</option>
                                        <option value="Pre-Beta" @if($test->version=="Pre-Beta") selected @endif>Pre-Beta</option>
                                        <option value="Beta" @if($test->version=="Beta") selected @endif>Beta</option>
                                        <option value="Released" @if($test->version=="Released") selected @endif>Released</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="divANGField"><label class="labelMain">Test status</label>
                                <p class="paraDANGF">Note: If you select the "Complete" option, it will disable sign-ups.</p><select class="custom-select inputMain" required=""name="test_status"value="{{$test->test_status}}">
                                    <optgroup label="Game test status" class="optgroupIDANGF">
                                        <option value="On-going" @if($test->test_status=="On-going") selected @endif >On-going</option>
                                        <option value="Complete" @if($test->test_status=="Complete") selected @endif >Complete</option>
                                    </optgroup>
                                </select>
                            </div>

                        </div>
                        <div class="divAddingNewGameCreateSaveBtn"><button class="divAddingNewGameCreateSaveBtn btn btnMain btnMainFull btnMainFullSmall" type="submit">save</button></div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="deletethumbnail" method="post" action="/tests/{{$test->id}}/deleteimage/0">
        @csrf
    </form>
    <form id="deletesc1" method="post" action="/tests/{{$test->id}}/deleteimage/1">
        @csrf
    </form>
    <form id="deletesc2" method="post" action="/tests/{{$test->id}}/deleteimage/2">
        @csrf
    </form>
    <form id="deletesc3" method="post" action="/tests/{{$test->id}}/deleteimage/3">
        @csrf
    </form>
    <form id="deletesc4" method="post" action="/tests/{{$test->id}}/deleteimage/4">
        @csrf
    </form>
    <form id="deletesc5" method="post" action="/tests/{{$test->id}}/deleteimage/5">
        @csrf
    </form>

    </x-app-layout>
<script type="text/javascript">
    let genres=<?php echo json_encode($test->genres, JSON_HEX_TAG); ?>;
    genres=JSON.parse(genres);
    elements=document.getElementsByName('genres[]');
    console.log(genres)
    console.log(elements[0].value)
    for(let i=0; i<genres.length;i++)
        for(let j=0; j<elements.length;j++)
        {
            if(genres[i]==elements[j].value)
                elements[j].checked = true;;
        }
</script>

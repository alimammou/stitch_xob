<x-app-layout>
    <x-slot name="header">

        <li class="nav-item navItem nIUser" id="showThisOnceLoggedIn">
            <div class="nav-item dropdown DDNavItem"><a class="dropdown-toggle linkDLUserNav" aria-expanded="false" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu menuDL">
                    <div class="divUserInfoNav">
                        <p class="dUINPara">Rank:&nbsp;<span class="dUINPSpan">Bronze</span></p>
                    </div><a class="dropdown-item mDLItem" href="/account">Account</a><a class="dropdown-item mDLItem" href="/notification">Notifications</a>
                    <a class="dropdown-item mDLItem mDLITomato" hrefd="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </li>

    </x-slot>

    <div class="divMainSec dMSNoPad">
        <div class="divCustomContainer">
            <div class="divPageTitleMain">
                <h2 class="headingPageTitleMain">Create Test</h2>
            </div>

            <div class="divDashboardBack"><a class="linkDB" href="dashboard">Back to dashboard</a></div>

            <form method="POST" action="/createtest"enctype="multipart/form-data">
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

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div class="divANGField"><label class="labelMain">Title</label><input type="text" class="inputMain" placeholder="Game title.." required="" name="title"></div>
                <div class="divANGField"><label class="labelMain">Description</label><textarea class="inputMain" placeholder="This game is a.." name="description"required=""></textarea></div>
                <div class="divANGField"><label class="labelMain">Thumbnail</label>
                    <p class="paraDANGF">Resolution must be: 1280x720 (Max size: 450 KB)</p><input type="file" accept="image/*" name="thumbnail"required="">
                </div>
                <div class="divANGField"><label class="labelMain">Screenshots</label>
                    <p class="paraDANGF">Resolution must be: 1280x720 (Max size: 450 KB). Maximum of 5 screenshots.</p><input type="file" multiple="" accept="image/*"name="sc1"><input type="file" multiple=""name="sc2" accept="image/*"><input type="file" multiple="" name="sc3"accept="image/*"><input type="file" multiple="" name="sc4"accept="image/*"><input type="file" multiple=""name="sc5" accept="image/*">
                </div>
                <div class="divANGField"><label class="labelMain">Trailer</label>
                    <p class="paraDANGF">If available</p><input type="text" class="inputMain" placeholder="Youtube link.." inputmode="url"name="trailer">
                </div>
                <div class="divANGField"><label class="labelMain">Platform</label>
                    <p class="paraDANGF">What platform are you testing on?</p><select class="custom-select inputMain" required=""name="platform_id">
                        <optgroup label="Game test platform" class="optgroupIDANGF">
                            @foreach($p as $platform)
                                <option value="{{$platform->id}}" >{{$platform->name}}</option>
                            @endforeach

                        </optgroup>
                    </select>
                </div>
                <div class="divANGField"><label class="labelMain">Genres</label>
                    <p class="paraDANGF">What genres does your game belong to?</p>
                    <div class="dropdown dropdownMultiSelectMain keep-open"><button class="btn btn-primary dropdown-toggle btnDDMSM" aria-expanded="false" data-toggle="dropdown" type="button">Genre/s</button>
                        <div class="dropdown-menu menuDDMSM">

                            @foreach($g as $genre)
                            <div class="custom-control custom-checkbox checkLabelDDMSM"><input class="custom-control-input checkCLDDMSM" type="checkbox" id="formCheck[{{$loop->index}}]" name="genres[{{$loop->index}}]"value="{{$genre->name}}"><label class="custom-control-label labelCLDDMSM" for="formCheck[{{$loop->index}}]">{{$genre->name}}</label></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="divANGField"><label class="labelMain">Page status</label>
                    <p class="paraDANGF">If this game test (page) will be live or not.</p><select class="custom-select inputMain" required=""name="page_status">
                        <optgroup label="Game test visibility" class="optgroupIDANGF">
                            <option value="1">Publised</option>
                            <option value="0">Draft</option>
                        </optgroup>
                    </select>
                </div>
                <div class="divANGField"><label class="labelMain">Tester registration</label>
                    <p class="paraDANGF">Can testers sign up for the this test?</p><select class="custom-select inputMain" required=""name="tester_registration">
                        <optgroup label="Game test visibility" class="optgroupIDANGF">
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </optgroup>
                    </select>
                </div>
                <div class="divANGField"><label class="labelMain">Reward pool</label>
                    <p class="paraDANGF">Notice: Once a single tester signs up for the test, the points that you add here cannot be removed unless you delete this test (resulting in losing your sign-up list for this test).</p><input type="number" class="inputMain" placeholder="Total reward points available for this test.." inputmode="numeric"name="rewardpool" Value="0">

                </div>
                <div class="divANGField"><label class="labelMain">Test version</label>
                    <p class="paraDANGF">What version of your game are you testing?</p><select class="custom-select inputMain" required=""name="version">
                        <optgroup label="Gane test versuib'" class="optgroupIDANGF">
                            <option value="Prototype">Prototype</option>
                            <option value="Alpha">Pre-Alpha</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Pre-Beta">Pre-Beta</option>
                            <option value="Beta">Beta</option>
                            <option value="Released">Released</option>
                        </optgroup>
                    </select>
                </div>
                <div class="divANGField"><label class="labelMain">Test status</label>
                    <p class="paraDANGF">Note: If you select the "Complete" option, it will disable sign-ups.</p><select class="custom-select inputMain" required=""name="test_status">
                        <optgroup label="Game test status" class="optgroupIDANGF">
                            <option value="On-going">On-going</option>
                            <option value="Complete">Complete</option>
                        </optgroup>
                    </select>
                </div>

            </div>
            <div class="divAddingNewGameCreateSaveBtn"><button class=" btn btnMain btnMainFull btnMainFullSmall" type="submit">Create</button></div>
            </form>
        </div>

    </div>
</div>

    </x-app-layout>
<script>$(document).on('click.bs.dropdown.data-api', '.keep-open', function (e) {
        e.stopPropagation();
    });</script>

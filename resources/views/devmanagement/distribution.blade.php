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


    <div class="divMainSec dMSNoPad">
        <div class="divCustomContainer">
            <div class="divPageTitleMain">
                <h2 class="headingPageTitleMain">Managing:&nbsp;<span class="spanPageTitleMain">{{$test->title}}</span></h2>
            </div>
            <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
            <div class="divDashboard DDManageTest">
                <div class="divDTabsHolder">
                    <div class="divDTabs"><a class="linkDT" href="/tests/{{$test->id}}/manage">Edit Test</a><a class="linkDT linkDTActive" href="/tests/{{$test->id}}/keysinvites">Keys &amp; Invites</a><a class="linkDT" href="/tests/{{$test->id}}/forms">Feedback Forms</a><a class="linkDT" href="/tests/{{$test->id}}/bugreports">Bug Reports</a><a class="linkDT " href="/tests/{{$test->id}}/nda">NDA</a></div>
                    <div class="divDOther">
                        <p class="divDOPara">Remaining points:&nbsp;<span class="divDOPSpan">{{$test->remaining_points}}</span></p>
                    </div>
                    <div class="divDOther"><a class="btn btnMain btnMainFull btnMainFullLighter btnMainFullLighter" role="button" href="/tests/{{$test->id}}/delete">Delete test</a></div>
                </div>

                <div class="divDContentHolder">
                    <div class="divDContent DDC">
                        <div class="DDCNav DDCNKeysInvites"><a class="linkDDCN" href="/tests/{{$test->id}}/keysinvites">Available Keys</a><a class="linkDDCN LDDCNActive" href="#">Distribution</a></div>
                    </div>
                    <div class="DDCInfoHolder">
                        <div class="DDCInfo">
                            <p class="DDCIPara">All keys:&nbsp;<span>{{$test->gamecodes_count}}</span></p>
                            <p class="DDCIPara">Remaining keys:&nbsp;<span>{{$test->not_sent}}</span></p>
                        </div>
                        <div class="DDCIHDivider"></div>
                        <div class="DDCInfo">
                            <p class="DDCIPara">Total sign-ups:&nbsp;<span>{{$test->testapps_count}}</span></p>
                            <p class="DDCIPara">Invited testers:&nbsp;<span>{{$test->invited}}</span></p>
                            <p class="DDCIPara">Claimed keys:&nbsp;<span>{{$test->claimed_keys}}</span></p>
                        </div>
                    </div>
                    <form action="/tests/{{$test->id}}/distribution" method="POST">
                        @csrf

                        @if(!$test->nda()->exists())
                            <div class="DDCNDAWarningDistribute">
                                <p class="DDCNDAWDPara">Notice: Make sure whether or not you want NDA enabled or not. This means that if you send keys to testers, and NDA is disabled for example, they will immediately gain access to the keys you've sent without having them accept an NDA.</p>
                            </div>
                        @endif
                    <div class="DDCDistribute">


                            @if ($errors->any())
                                <div>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <div class="DDCDSending">

                            <div class="DDCDS"><label class="labelMain">Send to</label><input type="number" name="number_of_testers" class="inputMain"required placeholder="1" min="1"@if($test->not_sent>($test->testapps_count-($test->gamecodes_count-$test->not_sent)))max="{{$test->testapps_count-($test->gamecodes_count-$test->not_sent)}}" @else max="{{$test->not_sent}}"@endif ></div>
                            <div class="DDCDS"><label class="labelMain">Distribution method</label><select class="inputMain">
                                    <optgroup label="Distribute" class="optgroupMain">
                                        <option value="0" selected="">Randomly</option>
                                    </optgroup>
                                </select></div>
                            <div class="DDCDS"><button class="btn btnMain btnMainFull btnMainFullLighter" type="submit"@if($test->not_sent==0) disabled title="you need to add keys first"@elseif(($test->testapps_count-($test->gamecodes_count-$test->not_sent))==0) disabled title="no new signups"@endif>Send</button></div>

                        </div>
                            </form>
                    </div>
                    <p style="margin: 0 0 20px 0;text-align: center;color: grey;line-height: 1;font-weight: bold;">Or</p>
                    <div class="DDCDistribute">
                        <div class="DDCDSending DDCDSLink">
                            <div class="DDCDS"><label class="labelMain">Download link</label><input type="text" class="inputMain" placeholder="link.. (saved upon sending)"></div>
                            <div class="DDCDS"><label class="labelMain">Send download link to (Testers)</label><input type="number" class="inputMain" placeholder="0"></div>
                            <div class="DDCDS"><label class="labelMain">Distribution method</label><select class="inputMain">
                                    <optgroup label="Distribute" class="optgroupMain">
                                        <option value="0" selected="">Randomly</option>
                                    </optgroup>
                                </select></div>
                            <div class="DDCDS"><button class="btn btnMain btnMainFull btnMainFullLighter" type="button">Send</button></div>
                        </div>
                    </div>
                    <p style="margin: 0 0 20px 0;text-align: center;color: grey;line-height: 1;font-weight: bold;">Or</p>
                    <div class="DDCDistribute">
                        <div class="DDCDSending">
                            <div class="DDCDS"><label class="labelMain">Download link</label><input type="text" class="inputMain" placeholder="link.. (saved upon sending)"></div>
                            <div class="DDCDS"><label class="labelMain">Allow anyone to become a tester instantly</label><select class="inputMain">
                                    <optgroup label="Enabled" class="optgroupMain">
                                        <option value="0" selected="">Disabled</option>
                                    </optgroup>
                                </select></div>
                            <div class="DDCDS"><button class="btn btnMain btnMainFull btnMainFullLighter" type="button">Save</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

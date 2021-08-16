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
                <h2 class="headingPageTitleMain">Dashboard</h2>
            </div>
            <div class="divDashboardDevOrTester"><a class="linkDOOT linkDOOTActive" href="#">Developer</a><a class="linkDOOT" href="/dashboard/tester">Tester</a></div>
            <div class="divDashboard">
                <div class="divDTabsHolder">
                    <div class="divDashboardPoints">
                        <p class="paraDPNote">As a&nbsp;<span class="spanPDPN">developer</span>, you have:</p>
                        <p class="paraDashboardPoints"><span class="spanDP">{{Auth::User()->points}}</span>&nbsp;of usable points.</p>
                        <p class="paraDashboardPoints"><span class="spanDP">{{$points}}</span>&nbsp;of locked to tests.</p>
                    </div>
                    <div class="divDTabs"><a class="linkDT" href="/dashboard">Manage tests</a><a class="linkDT linkDTActive" href="#">Purchase points</a></div>
                </div>
                <div class="divDContentHolder">
                    <div class="divDContent">
                        <div class="divDCPurchasePointsTop"><a class="divDCPPTLink" href="/dashboard/purchasepoints">Direct</a><a class="divDCPPTLink" href="/dashboard/exchange">Exchange</a><a class="divDCPPTLink divDCPPTLActive" href="#">Aid</a></div>
                        <div class="divDCPurchasePointsBottom">

                                @if ($errors->any())
                                    <div>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            <p class="divDCPPBPara">If you don't have the means to purchase points at the moment, we do have this option of providing indie developers with a little bit of help by sending a few points to reward a handful of testers.<br><br>Fill out the fields below with information related to the game you'd like to test on the Stitch platform, and submit your request. (There's no guarantee that you will receive points).</p>
                                <form action="/dashboard/aidrequest" method="POST" style="display:grid; grid-template-columns: 1fr;grid-gap: 20px;">
                                    @csrf
                                <div class="divDCPPBAidFields">

                                <div class="TP2GC"><label class="labelMain">Developer/studio name</label><input type="text" class="inputMain" name="name" hidden value="{{\Illuminate\Support\Facades\Auth::user()->devname}}"></div>
                                <div class="TP2GC"><label class="labelMain">Website (if available)</label><input type="text" class="inputMain"name="website" placeholder="Website link" inputmode="url"></div>
                                <div class="TP2GC"><label class="labelMain">Social media page/account</label><input type="text" class="inputMain"name="social_media" placeholder="Twitter or.." inputmode="url"></div>
                                <div class="TP2GC"><label class="labelMain">Gameplay footage</label><input type="text" class="inputMain"name="gameplay" placeholder="Youtube link or.." inputmode="url"></div>
                                <div class="TP2GC"><label class="labelMain">Number of expected players you'd like to test with</label><input type="text"required name="numberoftesters" class="inputMain" placeholder="10? 50? More?" inputmode="numeric"></div>
                            </div><button class="btn btnMain btnMainFull btnMainFullLighter" type="submit">Submit aid request</button>
                                </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    </x-app-layout>

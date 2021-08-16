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
                    <div class="divDCPurchasePointsTop"><a class="divDCPPTLink" href="/dashboard/purchasepoints">Direct</a><a class="divDCPPTLink divDCPPTLActive" href="#">Exchange</a><a class="divDCPPTLink" href="/dashboard/aidrequest">Aid</a></div>
                    <div class="divDCPurchasePointsBottom">
                        <p class="comingSoonText">Coming soon.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </x-app-layout>

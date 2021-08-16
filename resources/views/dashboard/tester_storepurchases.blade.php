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
                <div class="divDashboard">
                    <div class="divDTabsHolder">
                        <div class="divDashboardPoints">
                            <p class="paraDPNote">As a&nbsp;<span class="spanPDPN">Tester</span>, you have:</p>
                            <p class="paraDashboardPoints"><span class="spanDP">{{\Illuminate\Support\Facades\Auth::user()->tester_points}}</span>&nbsp;of spendable points</p>
                        </div>
                        <div class="divDTabs"><a class="linkDT" href="/dashboard">Registered tests</a><a class="linkDT linkDTActive" href="#">Store purchases</a></div>
                    </div>
                    <div class="divDContentHolder">
                        <div class="divDContent">
                            <div class="divDCStorePurchases">
                                @foreach(  $purchases as $purchase)
                                    <div class="DDCSPCardHolder">
                                        <div class="DDCSPDetailsHolder">
                                            <div class="DDCSPDetails DDCSPDTop">
                                                <p class="DDCSPDPara">Title:&nbsp;<a class="DDCSPDPLink" href="store-page.html">{{  $purchase->storeitem->title}}</a></p>
                                            </div>
                                        </div>
                                        <div class="DDCSPCard">
                                            <p class="DDCSPCPara">{{  $purchase->storecode->code}}</p><button class="btn btnMain DDCSPCBtn" type="button"><i class="fas fa-copy DDCSPCBIcon"></i></button>
                                        </div>
                                        <div class="DDCSPDetailsHolder">
                                            <div class="DDCSPDetails">
                                                <p class="DDCSPDPara">Redeemable on:&nbsp;<span class="DDCSPDPSpan">{{  $purchase->storeitem->platform->name}}</span></p>
                                                <p class="DDCSPDPara">Purchased on:&nbsp;<span class="DDCSPDPSpan">{{  $purchase->created_at->toDateString()}}</span></p>
                                                <p class="DDCSPDPara">Purchase for:&nbsp;<span class="DDCSPDPSpan">{{  $purchase->purchasedfor}}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{  $purchases->links('layouts.pagination')}}
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>

</x-app-layout>

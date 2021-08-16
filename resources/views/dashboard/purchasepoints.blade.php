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
                    <div class="divDTabs"><a class="linkDT" href="/dashboard">Manage tests</a><a class="linkDT linkDTActive" href="/dashboard/purchasepoints">Purchase points</a></div>
                </div>

                <div class="divDContentHolder">
                    <div class="divDContent">
                        <div class="divDCPurchasePointsTop"><a class="divDCPPTLink divDCPPTLActive" href="#">Direct</a><a class="divDCPPTLink" href="/dashboard/exchange">Exchange</a><a class="divDCPPTLink" href="/dashboard/aidrequest">Aid</a></div>

                                <form action="/buypoints" method="post">
                                    @csrf
                                <div class="divDCPurchasePointsBottom" >


                                    <div class="DDCTTCTP DDCTTCTP2Grid">

                                        <div class="DDCTTCTP2GCard">

                                            <div class="TP2GC"><label class="labelMain">I'd like to buy..</label>
                                                <div class="divTP2GCL"><input type="number" id="points" class="inputMain" placeholder="Number of points" name="points"inputmode="numeric"><button class="btn btnMain TP2GCICheckBtn" type="button" onclick="claculateprice()"><i class="fas fa-undo TP2GCICBIcon"></i></button></div>

                                            </div>
                                            @error('points')
                                            <p>{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="DDCTTCTP2GCard">
                                            <p class="TP2GCPara"><span class="TP2GCSpan" id="pointss">0,000</span>&nbsp;points is priced at $<span class="TP2GCSpan" id="price">00.00</span>, where you can reward an average of&nbsp;<span class="TP2GCSpan" id="testers">0,000</span> testers.<br></p>
                                        </div>

                                    </div>

                                    <div class="TCTPBtn"><button class="btn btnMain btnMainFull btnMainFullSmall btnMainFullSmallLighter" type="submit">Buy</button></div>

                                </div>
                                </form>

                        </div>
                    <div role="tablist" id="accordion-1" class="divFAQ divFAQPayment">
                        <div class="card dFAQCard">
                            <div class="card-header dFAQCHead" role="tab">
                                <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-1" href="#accordion-1 .item-1" class="dFAQCHHBtn">We're only accepting Bitcoin (+ Lightning) payments.</a></h5>
                            </div>
                            <div class="collapse item-1 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                                <div class="card-body">
                                    <p class="card-text dFAQCCPara">For the time being, we're only accepting Bitcoin payments (and Bitcoin on the Lightning Network) if you'd like to purchase points.<br><br>This is, at the moment, the best option for us until further notice.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card dFAQCard">
                            <div class="card-header dFAQCHead" role="tab">
                                <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="#accordion-1 .item-2" class="dFAQCHHBtn">What is Bitcoin?</a></h5>
                            </div>
                            <div class="collapse item-2 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                                <div class="card-body">
                                    <p class="card-text dFAQCCPara">"Bitcoin is a digital currency created in January 2009" .. "Bitcoin offers the promise of lower transaction fees than traditional online payment mechanisms and is operated by a decentralized authority, unlike government-issued currencies."<br><br>"There are no physical bitcoins, only balances kept on a public ledger that everyone has transparent access to, that – along with all Bitcoin transactions – is verified by a massive amount of computing power. Bitcoins are not issued or backed by any banks or governments, nor are individual bitcoins valuable as a commodity."</p><a class="btn btnMain btnMainFull btnMainFullLighter" role="button" href="https://bitcoin.org/en/" target="_blank">Learn more</a>
                                </div>
                            </div>
                        </div>
                        <div class="card dFAQCard">
                            <div class="card-header dFAQCHead" role="tab">
                                <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="#accordion-1 .item-3" class="dFAQCHHBtn">Where can I get Bitcoin?</a></h5>
                            </div>
                            <div class="collapse item-3 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                                <div class="card-body">
                                    <p class="card-text dFAQCCPara">There's various websites you can visit to exchange your local fiat currency (USD) to Bitcoin from. The simplest ones we know of would be&nbsp;<a class="linkFAQPay" href="https://fixedfloat.com/?ref=akvg9m4b" target="_blank">Fixedfloat</a>&nbsp;or&nbsp;<a class="linkFAQPay" href="https://changenow.io/?link_id=c1fccf4950afe9" target="_blank">ChangeNow</a>, but if you'd like to use the most popular exchange at the moment, that would be&nbsp;<a class="linkFAQPay" href="https://accounts.binance.com/en/register?ref=HMHQ6ZDP" target="_blank">Binance</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card dFAQCard">
                            <div class="card-header dFAQCHead" role="tab">
                                <h5 class="dFAQCHHeading"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-4" href="#accordion-1 .item-4" class="dFAQCHHBtn">What is the Lightning Network?</a></h5>
                            </div>
                            <div class="collapse item-4 dFAQCContent" role="tabpanel" data-parent="#accordion-1">
                                <div class="card-body">
                                    <p class="card-text dFAQCCPara">"The lightning network is a second layer technology applied to bitcoin that uses micropayment channels to scale its blockchain’s capability to conduct transactions more efficiently. Transactions conducted on lightning networks are faster, less costly, and more readily confirmed than those conducted directly on the bitcoin blockchain (i.e., on-chain)."</p><a class="btn btnMain btnMainFull btnMainFullLighter" role="button" target="_blank" href="https://www.investopedia.com/terms/l/lightning-network.asp">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
<script>
    function claculateprice()
    {
        let prices=<?php echo json_encode($pricing->points_price, JSON_HEX_TAG); ?>;
        prices=JSON.parse(prices);
        var value=document.getElementById("points").value;
        document.getElementById("pointss").innerHTML=value;
        document.getElementById("price").innerHTML="$"+value*prices;
        document.getElementById("testers").innerHTML=value/2;
    }
</script>

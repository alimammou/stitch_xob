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
        <div class="divPageTitleMain divMCHeading">
            <h2 class="headingPageTitleMain">Tests (or Store)</h2>
            <div class="divMC dMCSearch"><input type="search" class="inputMain"><button class="btn btnMain btnStoreSearch" type="submit"><i class="fas fa-search iconBSS"></i></button></div>
        </div>
        <div class="divSearchTerm">
            <p class="dSTPara">Search term (or genre):&nbsp;<span class="dSTPSpan">Game Title (or genre)</span></p>
        </div>
        <div class="divGridMain">
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-1" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-2" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-3" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-4" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-5" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-6" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-7" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-8" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-9" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-10" href="tests-page.html">View</a></div>
                </div>
            </div>
            <div class="divGMCard">
                <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                <div class="divGMContent">
                    <h5 class="headingGMC">Game Test Name</h5>
                    <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                    <div class="divBtnGMC"><a class="btn btnDGMC" role="button" id="gamePriceBTN-11" href="tests-page.html">View</a></div>
                </div>
            </div>
        </div>
        <div class="divPaginationMain">
            <div class="divPM">
                <div class="divPMArrow dPMALeft"><button class="btn btnPMA" type="button"><i class="fa fa-angle-double-left"></i></button><button class="btn btnPMA" type="button"><i class="fa fa-angle-left"></i></button></div>
                <div class="divPMNumbers"><button class="btn btnPMN bPMNActive" type="button">1</button><button class="btn btnPMN" type="button">2</button><button class="btn btnPMN" type="button">3</button><button class="btn btnPMN" type="button">4</button><button class="btn btnPMN" type="button">5</button></div>
                <div class="divPMArrow dPMARight"><button class="btn btnPMA" type="button"><i class="fa fa-angle-right"></i></button><button class="btn btnPMA" type="button"><i class="fa fa-angle-double-right"></i></button></div>
            </div>
        </div>
    </div>
</div>
    </x-app-layout>

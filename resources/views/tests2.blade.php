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


    <div class="divMainContent">
        <div class="divCustomContainer">
            <div class="divPageTitleMain divMCHeading">
                <h2 class="headingPageTitleMain">Tests</h2>
                <div class="divMC dMCSearch"><input type="search" class="inputMain"><a class="btn btnMain btnStoreSearch" role="button" href="searchGenreResults.html"><i class="fas fa-search iconBSS"></i></a></div>
            </div>
            <div class="divMCFilters">
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Platform</label><select class="custom-select inputMain" required="">
                        <optgroup label="Game Platform" class="optgroupIDANGF">
                            <option value="" selected="">Show all</option>
                            <option value="1">PC</option>
                            <option value="2">PS4</option>
                            <option value="3">PS5</option>
                            <option value="4">XB1</option>
                            <option value="5">XB1</option>
                            <option value="6">Mobile - Android</option>
                            <option value="7">Mobile - iOS</option>
                        </optgroup>
                    </select></div>
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">List order</label><select class="custom-select inputMain" required="">
                        <optgroup label="Game Priority Filter" class="optgroupIDANGF">
                            <option value="1">Newest</option>
                            <option value="2">Oldest</option>
                            <option value="3">Most popular</option>
                        </optgroup>
                    </select></div>
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Genre</label><select class="custom-select inputMain" required="">
                        <optgroup label="Game Genre" class="optgroupIDANGF">
                            <option value="0" selected="">Show all</option>
                            <option value="1">RPG</option>
                            <option value="2">FPS</option>
                            <option value="3">RTS</option>
                            <option value="4">Strategy</option>
                        </optgroup>
                    </select></div>
                <div class="dMCFSelectHolder"><label class="dMCFFieldLabel">Reward availability</label><select class="custom-select inputMain" required="">
                        <optgroup label="Test rewards" class="optgroupIDANGF">
                            <option value="0" selected="">Show both</option>
                            <option value="1">Has rewards</option>
                            <option value="2">No rewards</option>
                        </optgroup>
                    </select></div>
            </div>
            <div class="divGridMain">
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
                    </div>
                </div>
                <div class="divGMCard">
                    <div class="divGMCImg"><img class="imgGMCI" src="assets/img/bg-01-1.jpg"></div>
                    <div class="divGMContent">
                        <h5 class="headingGMC">Game Test Name</h5>
                        <div class="divGMCDetails"><i class="fab fa-steam iconGMCD"></i><i class="fas fa-gift iconGMCD iGMCDReward" data-toggle="tooltip" data-bss-tooltip="" title="Has rewards"></i></div>
                        <div class="divBtnGMC"><a class="btn btnDGMC" role="button" href="tests-page.html">View</a></div>
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
